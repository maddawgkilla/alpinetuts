<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.1/tailwind.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js"></script>
</head>
<body>
    <div x-data="game()" class="px-10 flex items-center justify-center min-h-screen">
        <h1 class="fixed top-0 right-0 p-10 font-bold text-3xl">
            <span x-text="points"></span>
            <span class="text-xs">pts</span>
        </h1>
        <div class="flex-1 grid grid-cols-4 gap-10">
            <template x-for="card in cards">
                <div>
                    <button
                        :style="'background: ' + (card.flipped ? card.color : '#999')" class="w-full h-32"
                        @click="flipCard(card)"
                        x-show="!card.cleared"
                    >
                    </button>
                </div>
            </template>
        </div>
    </div>

    <!-- Flash Message -->

    <div x-data="{ show: false, message: 'Default Message'}"
        class="fixed bottom-0 right-0 bg-green-500 p-2 mb-4 mr-4 rounded text-white"
        x-show="show"
        @flash.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 1000)"
        x-text="message"
        >
        <!-- <span x-text="message" class="pr-4"></span> -->
        <!-- <button @click="show = false">&times;</button> -->
    </div>

    <script>
        function pause(milliseconds = 1000) {
            return new Promise(resolve => setTimeout(resolve, milliseconds));
        };

        function flash(message) {
            window.dispatchEvent(new CustomEvent('flash', {
                detail: { message }
            }));
        }

        function game() {
            return {
                cards: [
                    { color: 'green', flipped: false, cleard: false },
                    { color: 'red', flipped: false, cleard: false },
                    { color: 'blue', flipped: false, cleard: false },
                    { color: 'yellow', flipped: false, cleard: false },
                    { color: 'green', flipped: false, cleard: false },
                    { color: 'red', flipped: false, cleard: false },
                    { color: 'blue', flipped: false, cleard: false },
                    { color: 'yellow', flipped: false, cleard: false }
                ],

                get flippedCards() {
                    return this.cards.filter(card => card.flipped);
                },

                get clearedCards() {
                    return this.cards.filter(card => card.cleared);
                },

                get remainingCards() {
                    // return this.cards.length - this.clearedCards.length;
                    return this.cards.filter(card => !card.cleared);
                },

                get points() {
                    return this.clearedCards.length;
                },

                pause(milliseconds) {
                    return new Promise(resolve => setTimeout(resolve, milliseconds));
                },

                async flipCard(card) {
                    if (this.flippedCards.length === 2) {
                        return;
                    }   
                    // console.log(card);
                    card.flipped = ! card.flipped;

                    if (this.flippedCards.length === 2) {
                        if (this.hasMatch()) {
                            flash('you found a match');
                            await pause();
                            this.flippedCards.forEach(card => card.cleared = true);

                            if(! this.remainingCards.length) {
                                alert("you won");
                            }
                        }
                        await pause();
                        this.flippedCards.forEach(card => card.flipped = false);
                    }
                },

                hasMatch() {
                    return this.flippedCards[0]['color'] === this.flippedCards[1]['color'];
                }
            };
        }
    </script>
</body>
</html>