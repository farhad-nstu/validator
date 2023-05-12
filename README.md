Step 1: By default, Composer pulls in packages from Packagist so you’ll have to make a slight adjustment to your new project composer.json file. Open the file and update include the following array somewhere in the object:
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/farhad-nstu/validator"
    }
]

Step 2: Now composer will also look into this repository for any installable package. Execute the following command to install the package:
Run the following command

composer require farhad-nstu/validator

Step 3: As you can see, the package has been installed successfully. Now, open the config/app.php file and scroll down to the providers array. In that array, there should be a section for the package service providers. Add the following line of code in that section:

/*
 * Package Service Providers...
 */
FarhadNstu\Validator\Providers\ValidatorProvidor::class,
