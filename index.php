<?php require_once 'vendor/autoload.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./dist/output.css" rel="stylesheet">
    <title>Prime Numbers Matrix</title>
</head>

<body class="bg-gray-900">

    <?php
    // get the number from the query string
    // typecast to double to check for decimal places
    // sanitise the input
    $number = isset($_GET['number']) ? (float) htmlspecialchars(trim($_GET['number'])) : false;
    // instantiate the class
    $primeMatrix = new GT\PrimeMatrix($number);
    ?>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="relative isolate overflow-hidden px-6 py-16 shadow-2xl sm:rounded-3xl sm:px-24 xl:py-32">
                <h2 class="mx-auto max-w-2xl text-center text-3xl font-bold tracking-tight text-white sm:text-4xl">Generate Prime Numbers Matrix</h2>
                <p class="mx-auto mt-2 max-w-xl text-center text-lg leading-8 text-gray-300">Input a number below, press enter and see the magic.</p>
                <form class="mx-auto mt-10 flex max-w-md gap-x-4">
                    <label for="number" class="sr-only">Number</label>
                    <!-- Using text field to showcase edge cases, otherwise number field can be used. -->
                    <input id="number" name="number" type="text" autocomplete="number" required value="<?php echo isset($_GET['number']) ? htmlspecialchars(trim($_GET['number'])) : ''; ?>" class="min-w-0 flex-auto rounded-md border-0 bg-white/5 px-3.5 py-2 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-white sm:text-sm sm:leading-6" placeholder="Enter a number">
                    <button type="submit" class="flex-none rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Generate</button>
                </form>
                <?php
                if ( isset( $primeMatrix->error ) && !empty( $primeMatrix->error ) ) :
                    ?>
                    <div class="mt-6 mx-auto max-w-md text-center text-red-600">
                        <p class="text-sm text-red-600" id="error"><?php echo $primeMatrix->error; ?></p>
                    </div>
                    <?php
                endif;
                ?>
                <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2" aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
                    <defs>
                        <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(512 512) rotate(90) scale(512)">
                            <stop stop-color="#7775D6" />
                            <stop offset="1" stop-color="#E935C1" stop-opacity="0" />
                        </radialGradient>
                    </defs>
                </svg>
            </div>
            <?php
            if ( isset( $primeMatrix->prime_numbers ) && !empty( $primeMatrix->prime_numbers ) && count( $primeMatrix->prime_numbers ) > 0 ) :
                ?>
                <div class="bg-grey-900 pb-16">
                    <div class="sm:flex sm:items-center">
                        <div class="py-8 sm:flex-auto">
                            <h1 id="result" class="text-base font-bold leading-6 text-white">Result:</h1>
                            <?php $matrix = $primeMatrix->number + 1; ?>
                            <p class="mt-2 text-sm text-gray-300">A scrollable <?php echo $matrix . "x" . $matrix; ?> matrix of first <?php echo htmlspecialchars($primeMatrix->number); ?> prime numbers as a multiplication table.</p>
                        </div>
                    </div>
                    <div class="overflow-x-scroll scroll-smooth">
                        <table class="max-w-3xl overflow-scroll table-auto min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-bold text-white sm:pl-0"></th>
                                    <?php foreach ($primeMatrix->prime_numbers as $key => $value) { ?>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-bold text-white sm:pl-0"><?php echo $value; ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                <?php foreach ($primeMatrix->prime_numbers as $key => $value) { ?>
                                    <tr>
                                        <th class="py-3.5 pl-4 pr-3 text-left text-sm font-bold text-white sm:pl-0"><?php echo $value; ?></th>
                                        <?php for ($i = 0; $i < count($primeMatrix->prime_numbers); $i++) { ?>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-normal text-gray-400 sm:pl-0"><?php echo $value * $primeMatrix->prime_numbers[$i]; ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>

</body>

</html>