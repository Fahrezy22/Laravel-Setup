<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ContractMakeCommand extends GeneratorCommand
{
    protected $signature = 'make:contract {name}';

    protected $description = 'Create a new contract class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/contract.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Contracts';
    }
}