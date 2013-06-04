    <div class='block'></div>    
    <div class='colMedium borderThick'>
        <div class='right'>
          <div class='padSmallx'>
            <span class='fButton'><?php echo $this->Html->link('add entry', array('action' => 'add')); ?></span>
          </div>
        </div>
      <div class='padSmallx'>
        <h3>Log</h3>
        </br>
        </br>
        </br>

        <?php foreach ($records as $record): ?>
        <div class='colFull borderTop'>
            <div id='logDate'>
                <div class='padSmallx'>
                    <span class='small'><?php echo $record['Record']['dose_date']; ?>
                    </span>
                    </br>
                </div>
            </div>
            <div id='logInfo'>
                <div class='padSmallx'>
                    <span class='medium'><?php echo $record['Record']['compound']; ?>
                    </span>
                    </br>
                    <span class='smallx red'><?php echo $record['Record']['dose']; ?> <?php echo $record['Record']['unit']; ?>
                    </span>
                    </br>
                    </br>
                    <h5><?php echo $record['Record']['title']; ?></h5>
                    </br>
                    <span class='smallx'><?php echo $record['Record']['report']; ?>
                    </span>
                </div>
            </div>
            <div class='clear'></div>
        </div>
        <div class='blockxSmall'></div>
        <?php endforeach; ?>
        <?php unset($post); ?>

        </br>
        </br>
      </div>
    </div>
  </BODY>
</HTML>
