<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcast Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
            background: linear-gradient(180deg, #4A1E73 0%, #D76D77 100%);
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .sidebar-visible {
            transform: translateX(0);
        }
        .toggle-moved {
            transform: translateX(16rem) translateY(-50%);
            transition: transform 0.3s ease-in-out;
        }
        .toggle-default {
            transform: translateX(0) translateY(-50%);
            transition: transform 0.3s ease-in-out;
        }
        .content-shifted {
            margin-left: 16rem;
            transition: margin-left 0.3s ease-in-out;
        }
        .content-full {
            margin-left: 0;
            transition: margin-left 0.3s ease-in-out;
        }
        #sidebarToggle {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-[#1E1E2E] text-white overflow-x-hidden">
    <div class="flex h-screen relative">
        <aside id="sidebar" class="sidebar w-64 text-white p-8 fixed h-full z-20 sidebar-visible">
            <div class="flex items-center gap-3 mb-8">
                <span class="material-icons text-4xl">account_circle</span>
                <h1 class="text-2xl font-bold">John Doe</h1>
            </div>
            <nav>
                <ul class="space-y-6">
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">home</span>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">analytics</span>
                            <span>Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="schedule.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">calendar_today</span>
                            <span>Schedule</span>
                        </a>
                    </li>
                    <li>
                        <a href="myepisode.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">mic</span>
                            <span>My Episodes</span>
                        </a>
                    </li>
                    <li>
                        <a href="new_podcast.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">add_circle</span>
                            <span>New Podcast</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">forum</span>
                            <span>Forum</span>
                        </a>
                    </li>
                    <li>
                        <a href="explore.php" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">explore</span>
                            <span>Explore</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <span class="material-icons">settings</span>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <button id="sidebarToggle" class="fixed left-0 top-4 bg-transparent p-2 z-30 toggle-moved">
            <span class="material-icons text-white">menu</span>
        </button>

        <main id="mainContent" class="flex-1 p-10 content-shifted">
            <h2 class="text-2xl font-bold mb-8">Dashboard</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-[#2E2E4E] p-6 rounded-xl">
                    <h3 class="text-xl font-semibold text-[#FFAF7B] mb-3">On Platform</h3>
                    <p class="text-gray-400">Key stats will appear here after publishing your first episode.</p>
                </div>
                <div class="bg-[#2E2E4E] p-6 rounded-xl">
                    <h3 class="text-xl font-semibold text-[#FFAF7B] mb-3">Latest Episodes</h3>
                    <p class="text-gray-400">Your latest episodes will be displayed here.</p>
                </div>
                <div class="bg-[#2E2E4E] p-6 rounded-xl">
                    <h3 class="text-xl font-semibold text-[#FFAF7B] mb-3">Monthly Listeners</h3>
                    <p class="text-gray-400">Listener statistics will appear here.</p>
                </div>
                <div class="bg-[#2E2E4E] p-6 rounded-xl">
                    <h3 class="text-xl font-semibold text-[#FFAF7B] mb-3">Upcoming Episodes</h3>
                    <p class="text-gray-400">Your scheduled episodes will appear here.</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        class Sidebar {
            constructor() {
                this.sidebar = document.getElementById('sidebar');
                this.sidebarToggle = document.getElementById('sidebarToggle');
                this.mainContent = document.getElementById('mainContent');
                this.initializeSidebar();
            }

            initializeSidebar() {
                this.sidebarToggle.addEventListener('click', () => {
                    this.toggleSidebar();
                });
            }

            toggleSidebar() {
                this.sidebar.classList.toggle('sidebar-hidden');
                this.sidebar.classList.toggle('sidebar-visible');
                this.mainContent.classList.toggle('content-shifted');
                this.mainContent.classList.toggle('content-full');
                this.sidebarToggle.classList.toggle('toggle-moved');
                this.sidebarToggle.classList.toggle('toggle-default');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            new Sidebar();
        });
    </script>
</body>
</html>