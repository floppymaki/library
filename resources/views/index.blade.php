<x-app-layout>

    <div class="relative isolate overflow-hidden px-6 py-24 sm:py-32 lg:overflow-visible lg:px-0">
  <div class="absolute inset-0 -z-10 overflow-hidden">
    <svg class="absolute left-[max(50%,25rem)] top-0 h-[64rem] w-[128rem] -translate-x-1/2 stroke-gray-200 [mask-image:radial-gradient(64rem_64rem_at_top,white,transparent)]" aria-hidden="true">
      <defs>
        <pattern id="e813992c-7d03-4cc4-a2bd-151760b470a0" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
          <path d="M100 200V.5M.5 .5H200" fill="none" />
        </pattern>
      </defs>
      <svg x="50%" y="-1" class="overflow-visible fill-gray-50">
        <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M-300.5 600h201v201h-201Z" stroke-width="0" />
      </svg>
      <rect width="100%" height="100%" stroke-width="0" fill="url(#e813992c-7d03-4cc4-a2bd-151760b470a0)" />
    </svg>
  </div>
  <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-2 lg:items-start lg:gap-y-10">
    <div class="lg:col-span-2 lg:col-start-1 lg:row-start-1 lg:mx-auto lg:grid lg:w-full lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
      <div class="lg:pr-4">
        <div class="lg:max-w-lg">
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Kupo!</h1>
            <p class="mt-6 text-xl leading-8 text-gray-700">
                Welcome to The Great Moogle Library, where books take flight and knowledge is as abundant as chocobos in the wild! 📚✨
            </p>

            <p class="mt-6 text-xl leading-8 text-gray-700">
                Nestled in the heart of fantasy, our library is a whimsical haven for readers, researchers, and anyone with a penchant for potions of the literary kind. As you step through our enchanted doors, you might just catch a glimpse of a mischievous moogle librarian fluttering about, organizing books with the precision of a well-trained chocobo.
            </p>

            <p class="mt-6 text-xl leading-8 text-gray-700">
                Here, the Dewey Decimal System has been replaced with the "Moogle Decimal System," where books are sorted by the fluffiness of their covers and the sparkle of their pages. From spellbinding spellbooks to epic tales of crystal quests, we've got a collection that even the most seasoned adventurers would envy.
            </p>

            <p class="mt-6 text-xl leading-8 text-gray-700">
                Our opening times, much like a well-crafted RPG quest, are designed for the convenience of both day and night owls:
            </p>

            <p class="mt-6 text-xl leading-8 text-gray-700">
                <span class="mb-2 block font-bold">🌙 Moonlit Hours:</span>
                <span class="mb-2 block">Monday to Friday: 6:00 PM - 12:00 AM</span>
                <span class="mb-2 block">Saturday and Sunday: 2:00 PM - 2:00 AM</span>

                <span class="mt-6 mb-2 block font-bold">☀ Sun-soaked Hours:</span>
                <span class="mb-2 block">Monday to Friday: 10:00 AM - 5:00 PM</span>
                <span class="block">Saturday and Sunday: 12:00 PM - 8:00 PM</span>
            </p>

            <p class="mt-6 text-xl leading-8 text-gray-700">
                So whether you're seeking knowledge like a scholar on a pilgrimage or just looking for a cozy spot to escape the hustle and bustle of the everyday grind, The Great Moogle Library is here to make your reading adventure as magical as a phoenix rising from the ashes. 📖🦉
            </p>

            <p class="mt-6 text-xl leading-8 text-gray-700">
                Come on in, grab a moogle-shaped bookmark, and let the literary magic begin! 📚✨</p>
            </p>

        </div>
      </div>
    </div>

    <div class="-ml-12 -mt-12 p-12 lg:sticky lg:top-4 lg:col-start-2 lg:row-span-2 lg:row-start-1 lg:overflow-hidden">
        <img class="w-[48rem] max-w-none rounded-xl bg-gray-900 shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem]" src="{{ asset('storage/images/mog_library.png') }}" alt="Moogle Library">
        <img class="mt-4 w-[48rem] max-w-none rounded-xl bg-gray-900 shadow-xl ring-1 ring-gray-400/10 sm:w-[57rem]" src="{{ asset('storage/images/mog_library2.png') }}" alt="Moogle Library">
    </div>


</x-app-layout>