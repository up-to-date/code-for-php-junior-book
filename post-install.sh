#!/bin/sh

if ! test -e "./.env"
then cp ./.env.sample ./.env
fi