<?php

use Axm\CopyLeaks\Api;
use Axm\CopyLeaks\Entities\Process;
use Axm\CopyLeaks\Request\RequestsAdapter;
use Axm\CopyLeaks\Entities\Result;
use Axm\CopyLeaks\Collections\ResultsCollection;
use Axm\CopyLeaks\Collections\ProcessesCollection;

describe(Api::class, function () {
    given('api', function () {
        $http = new RequestsAdapter();
        $api = new Api(
            $http,
            getenv('COPYLEAKS_EMAIL'),
            getenv('COPYLEAKS_API_KEY'),
            getenv('COPYLEAKS_PRODUCT')
        );

        $api->setSandboxModeEnabled(true);

        return $api;
    });
    it('exists', function () {
        expect(class_exists(Api::class))
            ->toBeTruthy();
    });
    it('can login', function () {
        $token = $this->api->login();
        expect($token)
            ->toBeA('string');
    });
    it('can retrieve a list of processes', function () {
        $list = $this->api->getActiveProcesses();
        expect($list)
            ->toBeAnInstanceOf(ProcessesCollection::class);
        expect($list->every(function ($element) {
            $class = Process::class;

            return ($element instanceof $class);
        }))->toBeTruthy();
    });
    context('When creating ' . Process::class, function () {
        it('can create from a url', function () {
            $url = 'http://shakespeare.mit.edu/midsummer/full.html';
            /** @var Process $process */
            $process = $this->api->createByUrl($url);
            expect($process)
                ->toBeAnInstanceOf(Process::class);
            expect($process->getId())
                ->toBeA('string');
            expect($process->getCreated())
                ->toBeAnInstanceOf(\DateTime::class);
            expect($process->getEtaSeconds())
                ->toBeA('int');
        });
        it('can create from text', function () {
            $file = SAMPLE_DOCS_DIR . 'doc1.txt';
            $text = file_get_contents($file);
            /** @var Process $process */
            $process = $this->api->createByText($text);
            expect($process)
                ->toBeAnInstanceOf(Process::class);
            expect($process->getId())
                ->toBeA('string');
            expect($process->getCreated())
                ->toBeAnInstanceOf(\DateTime::class);
            expect($process->getEtaSeconds())
                ->toBeA('int');
        });
    });
    context('When working with processes', function () {
        it('can check the status', function () {
            $process_id = '7e91ac75-35b7-41f3-bb50-431be1430ade';
            $status = $this->api->status($process_id);
            expect($status)
                ->toBeAn('int');
        });
        context('When getting results', function () {
            it('creates a ' . ResultsCollection::class, function () {
                $process_id = '7e91ac75-35b7-41f3-bb50-431be1430ade';
                $results = $this->api->result($process_id);
                expect($results)
                    ->toBeAnInstanceOf(ResultsCollection::class);
            });
            it('contains an array of ' . Result::class, function () {
                $process_id = '7e91ac75-35b7-41f3-bb50-431be1430ade';
                /** @var ResultsCollection $results */
                $results = $this->api->result($process_id);
                $actual = $results->every(function ($element) {
                    $result_class = Result::class;

                    return ($element instanceof $result_class);
                });
                expect($actual)
                    ->toBeTruthy();
            });
        });
    });
});