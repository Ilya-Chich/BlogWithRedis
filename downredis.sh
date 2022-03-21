#!/bin/bash
kill $(ps aux | grep 'redis-5.0.5/src/redis-server' | awk '{print $2}')