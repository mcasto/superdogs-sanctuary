<style>
    .news-container {
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    .news-nav {
        padding: 1rem;
        border-bottom: 1px solid #e3e3e0;
    }

    .news-nav h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding: 0 0.5rem;
    }

    .news-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .news-nav li {
        margin-bottom: 0.25rem;
    }

    .news-tab {
        width: 100%;
        text-align: left;
        padding: 0.5rem 0.75rem;
        border: none;
        background: transparent;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .news-tab:hover {
        background-color: #f5f5f4;
    }

    .news-tab.active {
        background-color: #f5f5f4;
        font-weight: 500;
    }

    .news-tab-title {
        display: block;
        font-size: 0.875rem;
    }

    .news-tab-date {
        display: block;
        font-size: 0.75rem;
        color: #706f6c;
        margin-top: 0.125rem;
    }

    .news-content-area {
        flex: 1;
        padding: 1.5rem;
    }

    .news-content {
        display: none;
    }

    .news-content.active {
        display: block;
    }

    @media (min-width: 1024px) {
        .news-container {
            flex-direction: row;
        }

        .news-nav {
            width: 280px;
            min-height: 100vh;
            border-bottom: none;
            border-right: 1px solid #e3e3e0;
            padding: 1.5rem;
        }

        .news-content-area {
            padding: 2rem;
        }
    }
</style>

<div class="news-container">
    <!-- Left Navigation -->
    <nav class="news-nav">
        <h2>News & Updates</h2>
        <ul>
            @foreach($newsItems as $index => $item)
                <li>
                    <button
                        class="news-tab {{ $index === 0 ? 'active' : '' }}"
                        data-news-index="{{ $index }}"
                        onclick="document.querySelectorAll('.news-tab').forEach(t => t.classList.remove('active')); this.classList.add('active'); document.querySelectorAll('.news-content').forEach(c => c.classList.remove('active')); document.querySelector('.news-content[data-news-index=&quot;{{ $index }}&quot;]').classList.add('active');"
                    >
                        <span class="news-tab-title">{{ $item['title'] }}</span>
                        <span class="news-tab-date">{{ \Carbon\Carbon::parse($item['date'])->format('M j, Y') }}</span>
                    </button>
                </li>
            @endforeach
        </ul>
    </nav>

    <!-- Right Content Area -->
    <main class="news-content-area">
        @foreach($newsItems as $index => $item)
            <article
                class="news-content {{ $index === 0 ? 'active' : '' }}"
                data-news-index="{{ $index }}"
            >
                @include($item['view'])
            </article>
        @endforeach
    </main>
</div>
