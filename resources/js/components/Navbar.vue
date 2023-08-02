<template>
    <div class=" flex justify-between items-center px-4 py-2">
        <!-- search form -->
        <div class="">
            <form action="">
                <div class="rounded  py-3 border px-3">
                    <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="text-gray-400" />
                    <input type="text" name="search" class=" outline-none ml-2" placeholder="Search">
                </div>
            </form>
        </div>
        <!-- user menu -->

        <div class="dropdown py-0">
            <label tabindex="0" class=" m-1 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <div class="w-[50px] h-[50px] overflow-hidden rounded-full">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="user">
                    </div>
                    <div class="username text-sm">Guest <span class="ml-2"><font-awesome-icon
                                icon="fa-solid fa-chevron-down" /></span></div>
                </div>
            </label>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-full">
                <li><a>Profile</a></li>
                <li><a>Logout</a></li>
            </ul>
        </div>

    </div>
</template>

<script setup>

</script>

