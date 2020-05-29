
copyEnv() {
    if [ ! -f .env ]; then
        echo "Generating .env file"
        cp .env.example .env
    fi
}

generateKey() {
    echo "Generating App Key"
    php artisan key:generate
}

migrateAll() {
    echo "Installing dabatase"
    php artisan migrate:install
    echo "Running migrations"
    php artisan migrate --step
}

linkStorage() {
    if [ ! -d "$WORKING_DIR/public/storage" ]; then
        echo "Linking storage folder"
        php artisan storage:link
    fi
}

makeUser() {
    echo "Generating testing user"
    php artisan make:user:test
}

install() {
    generateKey
    migrateAll
    linkStorage
    makeUser
}
