<?php $this->layout('layout', ['title' => 'Dashboard']) ?>

<?php $this->start('script') ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-slider.min.js"></script>
<?php if(ENVIRONMENT === 'local') :?>
<script src="/js/components/device.js"></script>
<script src="/js/components/dimmer.js"></script>
<script src="/js/components/relay.js"></script>
<script src="/js/components/battery.js"></script>
<script src="/js/components/thermostat.js"></script>
<script src="/js/components/temperature.js"></script>
<script src="/js/components/shortcut.js"></script>
<script src="/js/components/app.js"></script>
<script src="/js/components/listeners.js"></script>
<script src="/js/components/idle.js"></script>
<?php else : ?>
<script src="/js/compiled.min.js?v=<?php echo ASSETS_VERSION ?>"></script>
<?php endif; ?>
<script>
    Robot.shortcuts = <?php echo json_encode($shortcuts) ?>;
    Robot.rooms     = <?php echo json_encode($rooms) ?>;
    Robot.temps     = <?php echo json_encode($temps) ?>;
    Robot.booster   = '<?php echo $booster ?>';
    Robot.route();
    setTimeout(Robot.refresh,500)
</script>
<?php $this->stop() ?>

<div id="dash">

    <p class="pull-right data-refresh"><button class="btn btn-default" type="button" id="refresh">Refresh now <span class="glyphicon glyphicon-refresh"></span></button></p>

    <h1>Dashboard</h1>

    <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-star"></span> Shortcuts</div>
        <div class="panel-body" id="dash-shortcuts">
        </div>
    </div>

    <div class="panel panel-warning hidden" id="battery-panel">
        <div class="panel-heading"><span class="glyphicon glyphicon-exclamation-sign"></span> Battery alerts</div>
        <div class="panel-body" id="battery-wrap">
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-home"></span> Rooms</div>
        <div class="panel-body" id="dash-rooms">
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-asterisk"></span> Heating</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                    <h4>
                        Current: <strong class="temperature"><span id="temp-current"></span>&deg;</strong>
                    </h4>
                </div>
                <div class="col-xs-6">
                    <h4>
                        Target: <strong class="temperature"><span id="temp-target"></span>&deg;</strong>
                    </h4>
                </div>
            </div>
            <div id="dash-heating">
            </div>
            <hr>
            <form class="row" id="boost-form">
                <div class="col-xs-4">
                    <div class="input-group">
                        <input type="number" name="Setpoint" class="form-control" id="" min="5" max="25" value="19">
                        <div class="input-group-addon">&deg;</div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <select name="Duration" class="form-control">
                        <option value="1">1 hour</option>
                        <option value="2">2 hours</option>
                        <option value="3">3 hours</option>
                        <option value="4">4 hours</option>
                    </select>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-warning" id="boost" type="submit">Boost</button>
                </div>
                <div class="col-xs-12">
                    <p>Boost may take 20 mins to register</p>
                </div>
            </form>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading"><span class="glyphicon glyphicon-asterisk"></span> Radiator profiles</div>
        <div class="panel-body" id="dash-radiators">
        </div>
    </div>
</div>

<div id="room">
    <p class="go-back pull-right"><button class="btn btn-primary" type="button" id="back"><span class="glyphicon glyphicon-triangle-left"></span> Back</button></p>

    <h1 id="room-name"></h1>

    <div id="lights">
        <h2 class="page-header">Lights</h2>
        <div id="lights-devices"></div>
    </div>

    <div id="climate">
        <h2 class="page-header">Climate</h2>
        <div id="climate-devices"></div>
    </div>
</div>