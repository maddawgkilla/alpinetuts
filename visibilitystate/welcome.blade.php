<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
    <style>
        .active {
            color: blue;
        }
    </style>
</head>
<body>
    <div x-data="{ currentTab: 'first' }">
        <button @click="currentTab = 'first'" :class="{ 'active' : currentTab === 'first' }">First</button>
        <button @click="currentTab = 'second'" :class="{ 'active' : currentTab === 'second' }">Second</button>
        <button @click="currentTab = 'third'" :class="{ 'active' : currentTab === 'third' }">Thrid</button>

        <div style="border: 1px dotted grey; padding: 1rem; margin-top: 1rem;">
            <div x-show="currentTab === 'first'">
                <p>First tab</p>
            </div>
            <div x-show="currentTab === 'second'">
                <p>Second tab</p>
            </div>
            <div x-show="currentTab === 'third'">
                <p>Third tab</p>
            </div>
        </div>

    </div>
</body>
</html>