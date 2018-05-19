<?php
/**
 * @var Kahlan\Cli\Kahlan $this
 */
$spec_dir = implode(DS, [
    __DIR__,
    'tests',
    '',
]);
/** @var \Kahlan\Cli\CommandLine $commandLine */
$commandLine = $this->commandLine();
$commandLine->option('spec', 'default', $spec_dir);
$commandLine->option('cc', 'default', true);
$commandLine->option('reporter', 'default', 'verbose');
define('ROOT', (__DIR__) . DS);
define('SAMPLE_DOCS_DIR', ROOT . implode(DS, [
        'tests',
        'sample_docs',
        ''
    ]));
$env_file = ROOT . '.env';
if (file_exists($env_file)) {
    (new Dotenv\Dotenv(ROOT))->load();
}
