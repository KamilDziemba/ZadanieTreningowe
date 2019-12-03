<?php

declare(strict_types=1);

namespace App\Attractions\Infrastructure;


use App\Attractions\Application\ImportDataCommand;
use App\Attractions\Application\ImportDataHandler;
use App\Attractions\Application\ImportMailingAdapter;
use App\Shared\Exception\InvalidArgumentException;
use App\Shared\Mailing\MailService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class ImportExcelFileCommand extends Command
{
    public static $defaultName = 'app:import-excel';

    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var ImportDataHandler
     */
    private $importDataHandler;

    /**
     * @var MailService
     */
    private $mailService;

    /**
     * @var ImportMailingAdapter
     */
    private $importMailingAdapter;

    /**
     * ImportExcelFileCommand constructor.
     * @param string $projectDir
     * @param ImportDataHandler $importDataHandler
     * @param MailService $mailService
     * @param ImportMailingAdapter $importMailingAdapter
     */
    public function __construct(
        string $projectDir,
        ImportDataHandler $importDataHandler,
        MailService $mailService,
        ImportMailingAdapter $importMailingAdapter
    )
    {
        $this->projectDir = $projectDir;
        $this->importDataHandler = $importDataHandler;
        $this->mailService = $mailService;
        $this->importMailingAdapter = $importMailingAdapter;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Imports excel file.')
            ->setHelp('This command allows you to import excel file.')
            ->addArgument('filePath', InputArgument::REQUIRED);
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws InvalidArgumentException
     * @throws \App\Shared\Exception\InvalidFileContentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('filePath');
        $basePath = sprintf('%s/var/imports/%s', $this->projectDir, $filePath);
        $filesystem = new Filesystem();
        if (!$filesystem->exists($basePath)) {
            throw new InvalidArgumentException(sprintf('File does not exist %s', $filePath));
        }

        $importDataCommand = new ImportDataCommand($basePath);
        $recordsCreated = $this->importDataHandler->handle($importDataCommand);

        $mailDetail = $this->importMailingAdapter->adapt($recordsCreated);
        $this->mailService->sendEmail($mailDetail);


        return 200;
    }
}