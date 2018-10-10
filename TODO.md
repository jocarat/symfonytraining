Symfony 4
=========

Architecture
------------

1. Create controllers to use the various html files given.
2. Use the given templates through Twig.
3. Create a controller that will receive a letter and redirect
   for now to the game homepage. Please dump this letter before redirecting.
    1. Create the controller.
    2. Receive the letter.
    3. Ensure the letter **is** a letter.
    4. Dump the letter.
    5. Redirect to the game homepage.

Twig
----

1. Update the game homepage to use dynamic syntax.
    1. Display the right remaining attempts.
    2. Display as many "?" as there are letters
       in the word of the game.
    3. Display either the letter or "?" in the game,
       depending on if the letter has been guessed or not.
    4. Display the letters from A to Z from a loop.
2. Use a layout.
3. Export the menu section in a template.

Services
--------

1. Use `services.yml` to define the `GameRunner` in order to declare it as a service instead of building it manually.
