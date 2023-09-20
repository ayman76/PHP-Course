<?php require base_path('views\partials\header.php') ?>
<?php require base_path('views\partials\nav.php') ?>
<?php require base_path('views\partials\banner.php') ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

            <form method="post" action="/note">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">

                        <div class="col-span-full">
                            <label for="body"
                                   class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                            <div class="mt-2">
                                <textarea
                                        id="body"
                                        name="body"
                                        rows="3"
                                        placeholder="Here's an idea for a note..."
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                ><?= $note['body'] ?></textarea>
                            </div>

                            <?php if (isset($errors['body'])): ?>
                                <p class="text-red-500 text-xs mt-3"><?= $errors['body'] ?></p>
                            <?php endif ?>
                        </div>

                        <div class="px-4 py-3 text-right sm:px-6 flex gap-x-4 justify-end items-center">
                            <button type="button" class="text-red-500 mr-auto"
                                    onclick="document.querySelector('#delete-form').submit()">Delete
                            </button>

                            <a
                                    href="/notes"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                Cancel
                            </a>

                            <button
                                    type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Update
                            </button>
                        </div>
            </form>

            <form method="post" class="hidden" action="/note" id="delete-form">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $note['id']?>">
                <button class="text-red-500 mt-">Delete</button>
            </form>

        </div>
    </main>

<?php require base_path('views\partials\footer.php') ?>