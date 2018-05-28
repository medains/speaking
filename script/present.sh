#!/usr/bin/env bash

pushd . > /dev/null
SCRIPT_PATH="${BASH_SOURCE[0]}";
while([ -h "${SCRIPT_PATH}" ]); do
     cd "`dirname "${SCRIPT_PATH}"`"
     SCRIPT_PATH="$(readlink "`basename "${SCRIPT_PATH}"`")";
done
cd "`dirname "${SCRIPT_PATH}"`" > /dev/null
SCRIPT_PATH="`pwd`";
popd  > /dev/null

CMD=${SCRIPT_PATH}/node_modules/.bin/reveal-md
DIR=$1
shift

if [ \( "$DIR" == "" \) -o \( ! -d "$DIR" \) ]; then
    echo "Usage:   start.sh DIRECTORY"
    exit;
fi

if [ ! -x ${SCRIPT_PATH}/node_modules/.bin/reveal-md ]; then
   echo Need to npm install in ${SCRIPT_PATH}
   exit;
fi

pushd $DIR

ARGS=$*

SCRIPTS=""
if [ -d scripts ]; then
    SCRIPTS=$(find scripts -type f | tr '\n' ',' )
    ARGS="${ARGS} --scripts ${SCRIPTS// /}"
fi

$CMD index.md --preprocessor ${SCRIPT_PATH}/preprocess.js $ARGS
#$CMD index.md -$*

popd
