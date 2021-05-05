<div class="result_content">
    <div class="meanings">
        <div class="source">
            <b> <?= $result['meanings'][0]['source']; ?></b>
        </div>
        <div class="translations">
            <?php foreach ($result['meanings'] as $meaning):  ?>
                <div class="translation_details">
                    <i><?php
                        $grammar_note = !empty($meaning['grammar_note']) ? "(".$meaning['grammar_note'].") " : $meaning['grammar_note']; echo $grammar_note;
                        $reference = !empty($meaning['reference']) ? "см. "."<span class='reference' onclick='search(this.innerHTML)'>".$meaning['reference']."</span>" : $meaning['reference']; echo  $reference;
                        $note = !empty($meaning['note']) ? $meaning['note'] : $meaning['note']; echo $note;
                        $semantic_remark = !empty($meaning['semantic_remark']) ? $meaning['semantic_remark'] : $meaning['semantic_remark']; echo $semantic_remark;
                        ?>
                    </i>
                    <b><?= $meaning['translation']; ?></b>
                    <i><?php $clarification = !empty($meaning['clarification']) ? "(".$meaning['clarification'].")" : $meaning['clarification']; echo $clarification ?></i>
                    <i><?= $meaning['abbreviation']; ?></i>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <p class="examples_title"><?php $examples_title = !empty($result['examples']) ? _("Примеры в предложениях") : ""; echo $examples_title; ?></p>
    <div class="examples">
        <?php foreach ($result['examples'] as $example):  ?>
            <div class="example_item">
                <b><?= $example['source'] . " - "; ?></b><br>
                <span><?= $example['translation']; ?></span>
                <i><?php $clarification = !empty($example['clarification']) ? "(".$example['clarification'].")" : $example['clarification']; echo $clarification ?></i>
            </div>
        <?php endforeach; ?>

    </div>


</div>
