WORKING_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
DEVOPS="$WORKING_DIR/devops"

COMMAND=$1
shift

include() {
    ARG=$1
    FILE="$DEVOPS/$1.sh"
    if [ ! -x "$FILE" ]; then
        echo "$FILE does not exist or is not executable"
        exit 1
    fi
    source "$FILE"
}

case "$COMMAND" in
    env)
        include "install"
        copyEnv
        ;;
    install)
        include "install"
        install
        ;;
    build)
        include "build"
        build
        ;;
esac
