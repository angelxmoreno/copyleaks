<?php

use Axm\CopyLeaks\Api;

describe(Api::class, function () {
    it('exists', function () {
        expect(class_exists(Api::class))
            ->toBeTruthy();
    });
});