#!/bin/bash

netstat -ltnp|grep 8089|awk '{split($7, filearray, "/")};{print filearray[1]};'|xargs kill -9

