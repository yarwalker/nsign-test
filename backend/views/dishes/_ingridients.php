<?php
use yii\widgets\ListView;
?>
<div class="container-fluid ingridients">
    <p>Для формирования блюда перетащите нужные из доступных или перенесите ненужные в доступные ингридиенты</p>
    <div class="row">
        <div class="col-lg-6">
            <h4>Ингридиенты блюда:</h4>
            <div class="dish-ingridients">
                <?= ListView::widget([
                    'dataProvider' => $currentIngridientsProvider,
                    'itemView' => '_view3',
                    'summary' => false,

                ]); ?>
            </div>
        </div>
        <div class="col-lg-6">
            <h4>Доступные ингридиенты:</h4>
            <div class="available-ingridients">
                <?= ListView::widget([
                        'dataProvider' => $availableIngridientsProvider,
                        'itemView' => '_view2',
                        'summary' => false,

                    ]); ?>
            </div>
        </div>
    </div>
</div>