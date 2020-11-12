<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SortMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:sort 
                                {migration? : The name of target migration that you want to sort} 
                                {--top : Push a migration to top} 
                                {--bottom : Push a migration to bottom} 
                                {--exchange= : Swapping the position of two migraions} 
                                {--above= : Put one migration onto another} 
                                {--bellow= : Put one migration under another}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sorting the migrations.';

    protected $migrationPath;

    const MAX_LEN_POSITION_NUMBER = 6;
    const POSITION_MIGRATION_PATTERN = '/[0-9]{4}\_[0-9]{2}\_[0-9]{2}\_([0-9]{6})\_.*\.php/';
    const NAME_MIGRATION_PATTERN = '/[0-9]{4}\_[0-9]{2}\_[0-9]{2}\_[0-9]{6}\_(.*)\.php/';
    const PREFIX_MIGRATION_PATTERN = '/([0-9]{4}\_[0-9]{2}\_[0-9]{2}\_[0-9]{6})\_.*/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->migrationPath = database_path('migrations');
    }

    protected function getMigrations()
    {
        return File::allFiles($this->migrationPath);
    }

    protected function isValidInputBetweenTwoMigrations($targetMigration, $anotherMigration)
    {
        $isValid = true;

        if (! $anotherMigration || ! $this->getFileNameMigration($anotherMigration)) {
            $isValid = false;
            $this->showNoExistsSecondMigrationError();
        }

        if ($targetMigration === $anotherMigration) {
            $isValid = false;
            $this->showDulicatedMigrationError();
        }

        return $isValid;
    }

    protected function pushMigrationUpToTop($migration)
    {
        $this->sortedMigrations();
        $this->sortMigration($migration, 0);
        $this->resetSortedMigrations($start = 2, $from = 2);
        $this->sortMigration($migration, 1);

        return $this->showSuccessAlert();
    }

    protected function pushMigrationDownToBottom($migration)
    {
        $countMigration = count($this->getMigrations());

        $this->sortedMigrations();
        $this->sortMigration($migration, 0);
        $this->resetSortedMigrations($start = 1, $from = 2);
        $this->sortMigration($migration, $countMigration);

        return $this->showSuccessAlert();
    }

    protected function exchangeMirgation($targetMigration, $anotherMigration)
    {
        if (! $this->isValidInputBetweenTwoMigrations($targetMigration, $anotherMigration)) {
            return false;
        }

        $targetMigrationPos = $this->getPositionMigration($targetMigration);
        $anotherMigrationPos = $this->getPositionMigration($anotherMigration);

        $this->sortedMigrations();
        $this->sortMigration($targetMigration, 0);
        $this->sortMigration($anotherMigration, $targetMigrationPos);
        $this->sortMigration($targetMigration, $anotherMigrationPos);

        return $this->showSuccessAlert();
    }

    protected function putMigrationBellow($targetMigration, $anotherMigration)
    {
        if (! $this->isValidInputBetweenTwoMigrations($targetMigration, $anotherMigration)) {
            return false;
        }

        $targetMigrationPos = $this->getPositionMigration($targetMigration);
        $anotherMigrationPos = $this->getPositionMigration($anotherMigration);

        $this->sortedMigrations();
        $this->sortMigration($targetMigration, 0);

        if ($targetMigrationPos < $anotherMigrationPos) {
            $this->resetSortedMigrations(
                $start = 1, 
                $from = 2, 
                $end = $anotherMigrationPos
            );
            $this->sortMigration($targetMigration, $anotherMigrationPos);
        } else {
            $this->resetSortedMigrations(
                $start = $anotherMigrationPos + 2,
                $from = $anotherMigrationPos + 2
            );
            $this->sortMigration($targetMigration, $anotherMigrationPos + 1);
        }

        return $this->showSuccessAlert();
    }

    protected function putMigrationAbove($targetMigration, $anotherMigration)
    {
        if (! $this->isValidInputBetweenTwoMigrations($targetMigration, $anotherMigration)) {
            return false;
        }

        $targetMigrationPos = $this->getPositionMigration($targetMigration);
        $anotherMigrationPos = $this->getPositionMigration($anotherMigration);

        $this->sortedMigrations();
        $this->sortMigration($targetMigration, 0);

        if ($targetMigrationPos < $anotherMigrationPos) {
            $this->resetSortedMigrations(
                $start = 1, 
                $from = 2, 
                $end = $anotherMigrationPos - 1
            );
            $this->sortMigration($targetMigration, $anotherMigrationPos - 1);
        } else {
            $this->resetSortedMigrations(
                $start = $anotherMigrationPos + 1, 
                $from = $anotherMigrationPos + 1
            );
            $this->sortMigration($targetMigration, $anotherMigrationPos);
        }

        return $this->showSuccessAlert();
    }

    protected function createFileNameSortedMigration($migration, $pos)
    {
        while (strlen($pos) < self::MAX_LEN_POSITION_NUMBER) {
            $pos = '0' . $pos;
        }

        $newPrefixMigration = date('Y_m_d')."_{$pos}";

        return str_replace(
            $this->getPrefixMigration($migration), 
            $newPrefixMigration, 
            $this->getFileNameMigration($migration)
        );
    }

    protected function getFileNameMigration($migration)
    {
        foreach ($this->getMigrations() as $sortedMigration) {
            $fileNameMigration = $sortedMigration->getFileName();

            $matchFileNameMigration = $fileNameMigration == $migration;
            $containNameMigration = Str::of($fileNameMigration)->match(self::NAME_MIGRATION_PATTERN) == $migration; 

            if ($matchFileNameMigration || $containNameMigration) return $fileNameMigration;
        }
         
        return null;
    }

    protected function getPrefixMigration($migration)
    {
        return (string) Str::of($this->getFileNameMigration($migration))->match(self::PREFIX_MIGRATION_PATTERN);
    }
    
    protected function getPositionMigration($migration)
    {
        return (int)(string) Str::of($this->getFileNameMigration($migration))->match(self::POSITION_MIGRATION_PATTERN); 
    }

    protected function getNameMigration($migration)
    {
        return (string) Str::of($this->getFileNameMigration($migration))->match(self::NAME_MIGRATION_PATTERN); 
    }

    protected function sortMigration($migration, $sort)
    {
        $newFileNameMigration = $this->createFileNameSortedMigration($migration, $sort);

        File::move(
            $this->migrationPath.DIRECTORY_SEPARATOR.$this->getFileNameMigration($migration),
            $this->migrationPath.DIRECTORY_SEPARATOR.$newFileNameMigration
        );
    }

    protected function resetSortedMigrations($start, $from, $to = null)
    {
        $migrations = $this->getMigrations();
        $to = $to ?? count($migrations);

        for ($pos = $from; $pos <= $to; $pos++) {
            $this->sortMigration($migrations[$pos - 1]->getFileName(), $start++);
        }
    }

    protected function sortedMigrations()
    {
        $this->callSilent('db:wipe');

        $this->resetSortedMigrations($start = 1, $from = 1);
    }

    protected function showMigrations()
    {
        $this->sortedMigrations();

        $migrations = $this->getMigrations();
        $headers = ['#', 'Migration', 'Name'];

        $sortedMigrations = array_map(function($key, $migration) {
            $pos = $key + 1;
            $fileNameMigration = $migration->getFileName();
            $nameMigration = $this->getNameMigration($fileNameMigration);

            return [$pos, $fileNameMigration, $nameMigration];
        }, array_keys($migrations), $migrations); 

        return $this->table($headers, $sortedMigrations);
    }

    protected function showSuccessAlert()
    {
        $this->info('Migrations was sorted.');
        $this->info('Please migrate database again if that is last step.');
    }

    protected function showEmptyMigrationError()
    {
        return $this->error('You must type a migration.');
    }

    protected function showNoExistsMigrationError()
    {
        return $this->error("Migration was not found.");
    }

    protected function showNoExistsSecondMigrationError()
    {
        return $this->error("The second migration was not found.");
    }

    protected function showDulicatedMigrationError()
    {
        return $this->error("The migrations is dulicated.");
    }

    protected function showNoActionError()
    {
        return $this->error("Please type a action to sort the migration.");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $migration = $this->argument('migration');

        if (!$migration) {
            return $this->showMigrations();
        }

        if ($migration && ! $this->getFileNameMigration($migration)) {
            return $this->showNoExistsMigrationError();
        }

        if ($this->option('top')) {
            return $migration ? $this->pushMigrationUpToTop($migration) 
                              : $this->showEmptyMigrationError();
        }

        if ($this->option('bottom')) {
            return $migration ? $this->pushMigrationDownToBottom($migration) 
                              : $this->showEmptyMigrationError();
        }

        if ($this->option('exchange')) {
            return $migration ? $this->exchangeMirgation($migration, $this->option('exchange')) 
                              : $this->showEmptyMigrationError();
        }

        if ($this->option('above')) {
            return $migration ? $this->putMigrationAbove($migration, $this->option('above')) 
                              : $this->showEmptyMigrationError();
        }

        if ($this->option('bellow')) {
            return $migration ? $this->putMigrationBellow($migration, $this->option('bellow')) 
                              : $this->showEmptyMigrationError();
        }

        return $this->showNoActionError();
    }
}
