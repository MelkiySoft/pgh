<table class="result-table" border="1">
    <caption>Результаты поиска
 (всего найдено: <?php echo $this->data['responseGitHub']->countResult .
            ' репозиториев на ' .
            $this->data['responseGitHub']->paging['lastPage'] .
            'страницах'; ?>)</caption>
    <tr>
        <th>Имя</th>
        <th>Ссылка</th>
        <th>Размер, кБ</th>
        <th>Число форков</th>
        <th>Followers</th>
        <th>Звезд</th>
    </tr>

    <?php foreach ($this->data['responseGitHub']->repositories as $repository) { ?>
        <tr><td>
                <?php echo $repository->name; ?>
            </td><td>
                <?php echo $repository->url; ?>
            </td><td>
                <?php echo $repository->size; ?>
            </td><td>
                <?php echo $repository->forks; ?>
            </td><td>
                <?php echo 'недоступно'; ?>
            </td><td>
                <?php echo $repository->stars; ?>
            </td></tr>
    <?php } ?>
</table>

<div class="pagination">
    <?php
    if($this->data['responseGitHub']->paging['firstPage'] !== NULL ) {
        $num = $this->data['responseGitHub']->paging['firstPage'];
        echo '<input type="button" class="page-button active" onclick="apply(\'' . $num . '\')" value="<<">';
    }
    if($this->data['responseGitHub']->paging['prevPage'] !== NULL ) {
        $num = $this->data['responseGitHub']->paging['prevPage'];
        echo '<input type="button" class="page-button active" onclick="apply(\'' . $num . '\')" value="<">';
    }

        $num = $this->data['responseGitHub']->page;
        echo '<input type="button" class="page-button active" value="thisPage">';

    if($this->data['responseGitHub']->paging['nextPage'] !== NULL ) {
        $num = $this->data['responseGitHub']->paging['nextPage'];
        echo '<input type="button" class="page-button active" onclick="apply(\'' . $num . '\')" value=">">';
    }
    if($this->data['responseGitHub']->paging['lastPage'] !== NULL ) {
        $num = $this->data['responseGitHub']->paging['lastPage'];
        echo '<input type="button" class="page-button active" onclick="apply(\'' . $num . '\')" value=">>">';
    }
    ?>
</div>

<?php

//var_dump($this);

/*$arr = [
    'size' => ['>', 20],
    'forks' => ['>', 15],
    'stars' => ['>', 12],
    'followers' => ['>', 13]
];

$jSonString = json_encode($arr);
$inf = new RepoPage($jSonString);
$tmp = $inf->getArrRepos();
var_dump($tmp);*/