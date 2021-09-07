<?php $this->_t = 'Mon Blog';
foreach($articles as $article): ?>
<div class="container articles">
<h2><?= $article->title() ?></h2>
<p class="content"><?= $article->content() ?></p>
<time><?= $article->date() ?></time>
</div>
<?php endforeach; ?>
