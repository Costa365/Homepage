#!/bin/bash
docker build -t unitphp .
docker run --rm -it -v /home/costa/Projects/Costa365/src:/src unitphp
