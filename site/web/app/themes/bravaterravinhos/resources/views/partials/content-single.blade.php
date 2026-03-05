<article class="prose lg:prose-lg max-w-xs md:max-w-4xl mx-auto prose-a:no-underline prose-h3:text-xl prose-h2:mt-0 prose-picture:mt-0" @php(post_class('h-entry'))>
  <header>
    <h1 class="p-name text-secondary">
      {!! $title !!}
    </h1>

    @include('partials.entry-meta')
  </header>

  <div class="e-content">
    @php(the_content())
  </div>

  @if ($pagination())
    <footer>
      <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
      </nav>
    </footer>
  @endif

  @php(comments_template())
</article>
