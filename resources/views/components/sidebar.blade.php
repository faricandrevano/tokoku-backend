<aside id="mobile-menu"
    class="md:hidden fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidenav">
    <div
        class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('home') }}"
                    class="flex items-center p-2 text-base font-normal rounded-lg group {{ Request::is('/') ? 'text-white bg-primary-700 dark:bg-primary-700 hover:bg-primary-600' : 'hover:bg-gray-100 dark:text-gray-500' }}">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 {{ Request::is('/') ? 'text-white dark:text-white' : '' }} dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Overview</span>
                </a>
            </li>
            <li>
                <a href="{{ route('report/show') }}"
                    class="flex items-center p-2 text-base font-normal rounded-lg group {{ Request::is('report/show') ? 'text-white bg-primary-700 dark:bg-primary-700 hover:bg-primary-600' : 'hover:bg-gray-100 dark:text-gray-500' }}">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 {{ Request::is('report/show') ? 'text-white dark:text-white' : '' }} dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Diagram Penjualan</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center p-2 w-full text-base font-normal rounded-lg group {{ Request::is('product*') ? 'text-white bg-primary-700 dark:bg-primary-700 hover:bg-primary-600' : 'hover:bg-gray-100 dark:text-gray-500' }}"
                    aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 {{ Request::is('product*') ? 'text-white dark:text-white' : '' }} dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Sales</span>
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('product') }}"
                            class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Product</a>
                    </li>
                    <li>
                        <a href="{{ route('product/gallery') }}"
                            class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Gallery</a>
                    </li>
                    <li>
                        <a href="{{ route('product/category') }}"
                            class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Category</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('transaction') }}"
                    class="flex items-center p-2 text-base font-normal rounded-lg group {{ Request::is('transaction*') ? 'text-white bg-primary-700 dark:bg-primary-700 hover:bg-primary-600' : 'hover:bg-gray-100 dark:text-gray-500' }}">
                    <svg aria-hidden="true"
                        class="w-6 h-6 text-gray-400 transition duration-75 {{ Request::is('transaction*') ? 'text-white dark:text-white' : '' }} dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                        </path>
                        <path
                            d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                        </path>
                    </svg>
                    <span class="ml-3">Transaction</span>
                </a>
            </li>
        </ul>
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
            <li>
                <a href="{{ route('chat') }}"
                    class="flex items-center p-2 text-base font-normal rounded-lg group {{ Request::is('chat*') ? 'text-white bg-primary-700 dark:bg-primary-700 hover:bg-primary-600' : 'hover:bg-gray-100 dark:text-gray-500' }}">
                    <svg class="w-6 h-6 text-gray-400 transition duration-75 {{ Request::is('chat*') ? 'text-white dark:text-white' : '' }} dark:text-gray-400"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18" fill="currentColor">
                        <path
                            d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z"
                            fill="currentColor" />
                        <path
                            d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z"
                            fill="currentColor" />
                    </svg>
                    <span class="ml-3">Chat</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
