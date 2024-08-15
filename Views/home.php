<h2>Home</h2>
<?php if(session()->has('user')): ?>
    <p>Olá, <?=session()->get('user')->name?></p>
    <a href="<?php echo url_to('login.destroy')?>">logout</a>

    <pre><?php var_dump(session()->get('user'))?></pre>
<?php endif ?>