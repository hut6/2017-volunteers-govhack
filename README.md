# Mobilize 


        "build:dev": [
            "bin/console doctrine:database:drop --force --if-exists",
            "bin/console doctrine:database:create",
            "@load:fixtures"
        ],
        "load:fixtures": [
            "bin/console doctrine:migrations:migrate -n --allow-no-migration",
            "bin/console doctrine:fixtures:load -n"
        ],