<?php require 'partials\header.php' ?>
<?php require 'partials\nav.php' ?>
<?php require 'partials\banner.php' ?>


<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <form method="post">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">

                    <div class="col-span-full">
                        <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                                <textarea
                                        id="body"
                                        name="body"
                                        rows="3"
                                        placeholder="Here's an idea for a note..."
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                ><?= $_POST['body'] ?? '' ?></textarea>
                        </div>

                        <?php if (isset($errors['body'])): ?>
                            <p class="text-red-500 text-xs mt-3"><?= $errors['body'] ?></p>
                        <?php endif ?>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Save
                        </button>
                    </div>
        </form>

    </div>
</main>

<?php require 'partials\footer.php' ?>
