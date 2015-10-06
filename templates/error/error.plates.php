<?php $this->layout('app::layout', ['title' => 'Application Error']) ?>

<h1>Application Error</h1>
<p>There was an internal error with the application</p>
<p><i><?=$this->e($error)?></i></p>
