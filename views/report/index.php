<?php
/* @var $this yii\web\View */
/** @var \app\models\Branch[] $branches */
/** @var \app\models\Item[] $items */

$this->title = 'Отчёт ревизии';
?>
<h1><?= $this->title?></h1>

<?php foreach ($branches as $branch): ?>
    <?php if (count($items = $branch->items)):?>
        <h2><?= "Филиал \"{$branch->name}\""?></h2>

        <table class="report">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= $item->name?></td>
                        <td><?= $item->getStatus()?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif;?>
<?php endforeach; ?>