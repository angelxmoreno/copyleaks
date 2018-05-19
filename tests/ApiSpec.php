<?php

use Axm\CopyLeaks\Api;
use Axm\CopyLeaks\Entities\Process;
use Axm\CopyLeaks\Request\RequestsAdapter;
use Axm\CopyLeaks\Entities\Result;
use Axm\CopyLeaks\Collections\ResultsCollection;
use Axm\CopyLeaks\Collections\ProcessesCollection;
use Axm\CopyLeaks\Entities\ComparisionReport;

describe(Api::class, function () {
    given('process_id', function () {
        return '7e91ac75-35b7-41f3-bb50-431be1430ade';
    });
    given('result_id', function () {
        return 4180468;
    });
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
            $status = $this->api->status($this->process_id);
            expect($status)
                ->toBeAn('int');
        });
        context('When getting results', function () {
            it('creates a ' . ResultsCollection::class, function () {
                $results = $this->api->result($this->process_id);
                expect($results)
                    ->toBeAnInstanceOf(ResultsCollection::class);
            });
            it('contains an array of ' . Result::class, function () {
                $results = $this->api->result($this->process_id);
                $actual = $results->every(function ($element) {
                    $result_class = Result::class;

                    return ($element instanceof $result_class);
                });
                expect($actual)
                    ->toBeTruthy();
            });
        });
    });
    fcontext('When working with downloads', function () {
        it('can get a source text', function () {
            $text = $this->api->sourceText($this->process_id);
            expect($text)
                ->toBeA('string');
        });
        it('can get a result text', function () {
            $text = $this->api->resultText($this->result_id);
            expect($text)
                ->toBeA('string');
        });
        it('can get a comparison report', function () {
            $report = $this->api->comparisonReport($this->result_id);
            expect($report)
                ->toBeAnInstanceOf(ComparisionReport::class);
        });
    });
});