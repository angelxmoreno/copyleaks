#!/usr/bin/env ash

export $(cat .env | grep -v ^# | xargs) && \
./bin/kahlan --cc=true --reporter=bar --coverage=4 --clover=clover.xml && CODECLIMATE_REPO_TOKEN=${CODECLIMATE_REPO_TOKEN} ./bin/test-reporter --coverage-report=clover.xml