{{--
  Title: Landing Page Top
  Category: formatting
  Icon: admin-comments
  Keywords: home landing page quote
  Mode: edit
  Align: wide
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: true
--}}

@php global $post;
    $post_classes = ''; 
    $format = '';
@endphp

<div id="{{ $block['id'] }}" class="wp-block {{ $block['classes'] }}">
  <div class="row">
    <div class="col-md-6 left-column">
      <div class="post-group format-featured">
      
        @php $featured = get_field('featured_post') ?: null @endphp
        @if($featured)
          @php $featuredID = $featured->ID @endphp
        @else
          @php $featuredID = '' @endphp
        @endif
  
        @component('partials.post-item-featured', [
          'picture' => get_field('featured_image'),
          'post_object' => $featured
        ])@endcomponent
      </div>

      
      @if($block['secondary_featured'])
      @php $secondFeaturedID = $block['secondary_featured']->ID @endphp
      {{-- Secondary Feature --}}
      <div class="secondary">
        @component('partials.post-item-featured', [
          'picture' => '',
          'post_object' => $block['secondary_featured']
          ])@endcomponent
      </div>
      @else
      @php $secondFeaturedID = ''; @endphp

        {{-- PODCAST --}}
        <div class="podcast">
          <div class="section-title">
            <h2>Podcast</h2>
          </div>
          @component('partials.post-group', [
            'posts_per_page' => 1,
            'cat' => '147', //Entrepreneur Stories, Focus Points and "Articles Offering Advice and Tips to Women Entrepreneurs”
            'additional_args' => [
              'post__not_in' => array($featuredID, $secondFeaturedID)
            ],
            'format' => 'horizontal',
            'post_classes' => 'col-12',
            'featured_post' => false,
            'showExcerpt' => false
            ])@endcomponent
        </div>
        @endif
    </div>
    
    @php $exclude_categories = get_field('exclude_categories') @endphp

    <div class="col-md-3" id="middleColumn">
      @component('partials.post-group', [
      'posts_per_page' => 3,
      'additional_args' => [
        'post__not_in' => array($featuredID, $secondFeaturedID),
        'category__not_in' => $exclude_categories
      ],
      'format' => 'vertical',
      'post_classes' => '',
      'featured_post' => false,
      'showExcerpt' => false
    ])@endcomponent
    </div>

    <div class="col-md-3" id="latest-posts">
      <h4>The Latest</h4>
      @component('partials.post-group', [
      'posts_per_page' => 6,
      'additional_args' => [
        'offset' => 3,
        'post__not_in' => array($featuredID),
        'category__not_in' => $exclude_categories
      ],
      'format' => 'minimal',
      'post_classes' => 'col-12',
      'featured_post' => false,
      'showExcerpt' => false
    ])@endcomponent
    </div>

    {{-- PODCAST MOBILE --}}
    <div class="podcast" id="podcastMobile">
        <div class="section-title">
          <h2>Podcast</h2>
        </div>
        @component('partials.post-group', [
        'posts_per_page' => 1,
        'cat' => '147', //Entrepreneur Stories, Focus Points and "Articles Offering Advice and Tips to Women Entrepreneurs”
        'additional_args' => [
          'post__not_in' => array($featuredID)
        ],
        'format' => 'horizontal',
        'post_classes' => 'col-12',
        'featured_post' => false,
            'showExcerpt' => false
      ])@endcomponent
      </div>
  </div>
</div>