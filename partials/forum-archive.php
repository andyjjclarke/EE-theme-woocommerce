<aside class="col col-primary-content full-width forum-archive three-col-overline">
    <h1>Forum Archive</h1>
    <?php if (($currentYear = get_field('current_year', 'option')) != null): ?>
        <div class="col">
            <h2><?php echo $currentYear->name; ?></h2>
            <ul>
                <li><a href="<?php echo get_term_link($currentYear); ?>"><?php echo $currentYear->name; ?></a></li>
                <?php
                $terms = get_terms(array('forum_year'), array(
                    'parent' => $currentYear->term_id
                ));
                foreach ($terms as $term):
                ?>
                <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?> (<?php echo $term->count; ?>)</a></li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="col">
        <h2>Category</h2>
        <ul>
            <?php
            $terms = get_terms(array('forum_categories'));
            foreach ($terms as $term):
            ?>
            <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?> (<?php echo $term->count; ?>)</a></li>
            <?php
            endforeach;
            ?>
        </ul>
    </div>
    <div class="col">
        <h2>Year</h2>
        <ul>
            <?php
            $terms = get_terms(array('forum_year'), array(
                'parent' => 0
            ));
            foreach ($terms as $term):
            ?>
            <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
            <?php
            endforeach;
            ?>
        </ul>
    </div>
</aside>