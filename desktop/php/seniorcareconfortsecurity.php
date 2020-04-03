<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
$plugin = plugin::byId('seniorcareconfortsecurity');
sendVarToJS('eqType', $plugin->getId());
$eqLogics = eqLogic::byType($plugin->getId());
?>

<div class="row row-overflow">

  <div class="col-xs-12 eqLogicThumbnailDisplay">
    <legend><i class="fas fa-cog"></i>  {{Gestion}}</legend>
    <div class="eqLogicThumbnailContainer">
        <div class="cursor eqLogicAction logoPrimary" data-action="add">
          <i class="fas fa-plus-circle"></i>
          <br>
          <span>{{Ajouter}}</span>
      </div>
        <div class="cursor eqLogicAction logoSecondary" data-action="gotoPluginConf">
        <i class="fas fa-wrench"></i>
      <br>
      <span>{{Configuration}}</span>
    </div>
    </div>
    <legend><i class="fas fa-table"></i> {{Personne dépendante}}</legend>
  	   <input class="form-control" placeholder="{{Rechercher}}" id="in_searchEqlogic" />
  <div class="eqLogicThumbnailContainer">
      <?php
  foreach ($eqLogics as $eqLogic) {
  	$opacity = ($eqLogic->getIsEnable()) ? '' : 'disableCard';
  	echo '<div class="eqLogicDisplayCard cursor '.$opacity.'" data-eqLogic_id="' . $eqLogic->getId() . '">';
  	echo '<img src="' . $plugin->getPathImgIcon() . '"/>';
  	echo '<br>';
  	echo '<span class="name">' . $eqLogic->getHumanName(true, true) . '</span>';
  	echo '</div>';
  }
  ?>
  </div>
  </div>

<div class="col-xs-12 eqLogic" style="display: none;">
		<div class="input-group pull-right" style="display:inline-flex">
			<span class="input-group-btn">
				<a class="btn btn-default btn-sm eqLogicAction roundedLeft" data-action="configure"><i class="fa fa-cogs"></i> {{Configuration avancée}}</a><a class="btn btn-default btn-sm eqLogicAction" data-action="copy"><i class="fas fa-copy"></i> {{Dupliquer}}</a><a class="btn btn-sm btn-success eqLogicAction" data-action="save"><i class="fas fa-check-circle"></i> {{Sauvegarder}}</a><a class="btn btn-danger btn-sm eqLogicAction roundedRight" data-action="remove"><i class="fas fa-minus-circle"></i> {{Supprimer}}</a>
			</span>
		</div>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#" class="eqLogicAction" aria-controls="home" role="tab" data-toggle="tab" data-action="returnToThumbnailDisplay"><i class="fa fa-arrow-circle-left"></i></a></li>
    <li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fas fa-tachometer-alt"></i> {{Général}}</a></li>

    <li role="presentation"><a href="#conforttab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-spa"></i> {{Confort}}</a></li>

    <li role="presentation"><a href="#securitytab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fas fa-exclamation-triangle"></i> {{Sécurité}}</a></li>

    <li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> {{Avancé - Commandes Jeedom}}</a></li>

  </ul>

  <div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">

    <!-- TAB GENERAL -->
    <div role="tabpanel" class="tab-pane active" id="eqlogictab">
      <br/>
      <form class="form-horizontal">
        <fieldset>
          <div class="form-group">
            <label class="col-sm-3 control-label">{{Nom de la personne dépendante}}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
              <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de la personne dépendante}}"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" >{{Objet parent}}</label>
            <div class="col-sm-3">
              <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                <option value="">{{Aucun}}</option>
                <?php
                  foreach (jeeObject::all() as $object) {
  	                echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
                  }
                ?>
              </select>
            </div>
          </div>
  	   <!--div class="form-group">
                  <label class="col-sm-3 control-label">{{Catégorie}}</label>
                  <div class="col-sm-9">
                   <?php
                    //  foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
                    //  echo '<label class="checkbox-inline">';
                    //  echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
                    //  echo '</label>';
                    //  }
                    ?>
                 </div>
             </div-->
        	<div class="form-group">
        		<label class="col-sm-3 control-label"></label>
        		<div class="col-sm-9">
        			<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
        			<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
        		</div>
        	</div>
         <!--div class="form-group">
          <label class="col-sm-3 control-label">{{template param 1}}</label>
          <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="city" placeholder="param1"/>
          </div>
      </div-->
        </fieldset>
      </form>
    </div>

    <!-- TAB Capteurs Confort -->
    <div class="tab-pane" id="conforttab">
      <br/>
      <div class="alert alert-info">
        {{Onglet de configuration des capteurs de confort du logement, de définition des seuils de confort et des actions à réaliser en cas de sortie de ces seuils.}}
      </div>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-spa"></i> {{Capteurs confort}} <sup><i class="fas fa-question-circle tooltips" title="{{Capteurs de déclenchement d'alerte en cas de sortie des seuils définis.}}"></i></sup>
            <a class="btn btn-success btn-sm addSensorConfort" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter un capteur}}</a>
          </legend>
          <div id="div_confort"></div>
        </fieldset>
      </form>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-bomb"></i> {{Actions avertissement (pour chaque capteur hors seuils, je dois ?)}} <sup><i class="fas fa-question-circle tooltips" title="{{Actions réalisées dès la sortie des seuils d'un capteur de confort.
          Actions à définir pour la personne dépendante et/ou pour les aidants.
          Des actions complexes peuvent être créées par scenario.
          Tags utilisables : #senior_name#, #sensor_name#, #sensor_type#, #sensor_value#, #low_threshold#, #high_threshold#, #unit#.}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_warning_confort" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>
          <div id="div_action_warning_confort"></div>

          <label class="col-sm-2 control-label">{{Gestion de la répétition }}
          </label>
          <div class="col-sm-2">
            <select class="eqLogicAttr form-control tooltips" data-l1key="configuration" data-l2key="repetition_warning">
              <option value="once">Une seule fois</option>
              <option value="15min">Toutes les 15 min</option>
              <option value="1hour">Toutes les heures</option>
              <option value="6hours">Toutes les 6 heures</option>
            </select>
          </div>

        </fieldset>
      </form>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-hand-paper"></i> {{Actions arrêt d'avertissement - pour chaque capteur de retour dans les seuils, je dois ?}} <sup><i class="fas fa-question-circle tooltips" title="{{Actions réalisées lorsqu'un capteur précédemment hors seuils retourne dans ses bornes.
          Tag utilisable : #senior_name#.}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_cancel_warning_confort" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>
          <div id="div_action_cancel_warning_confort"></div>

        </fieldset>
      </form>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-hand-peace"></i> {{Actions arrêt d'avertissement - lorsque tous les capteurs sont dans les seuils, je dois ?}} <sup><i class="fas fa-question-circle tooltips" title="{{Actions réalisées lorsque tous les capteurs sont à l'intérieur des seuils définis.
          Tag utilisable : #senior_name#.}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_cancel_all_warning_confort" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>
          <div id="div_action_cancel_all_warning_confort"></div>

        </fieldset>
      </form>

    </div>

    <!-- TAB Capteurs Sécurité -->
    <div class="tab-pane" id="securitytab">
      <br/>
      <div class="alert alert-info">
        {{Onglet de configuration des capteurs de sécurité du logement ainsi que des actions à réaliser en cas de déclenchement}}
      </div>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-exclamation-triangle"></i> {{Capteurs Sécurité}} <sup><i class="fas fa-question-circle tooltips" title="{{Capteurs déclenchant une alerte de sécurité immédiate sur chaque activation}}"></i></sup>
            <a class="btn btn-success btn-sm addSensorSecurity" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter un capteur}}</a>
          </legend>
          <div id="div_security"></div>
        </fieldset>
      </form>

      <br>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-bomb"></i> {{Actions alerte immédiate}} <sup><i class="fas fa-question-circle tooltips" title="{{Actions réalisées à l'activation d'un capteur de sécurité.
          Tag utilisable : #senior_name#, #sensor_name# ou #sensor_type#}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_security" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>
          <div id="div_action_security"></div>

        </fieldset>
      </form>

      <br>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-toggle-off"></i> {{Boutons d'annulation d'alerte (quel actionneur pour couper l'alerte ?)}} <sup><i class="fas fa-question-circle tooltips" title="{{Bouton de désactivation de l'alerte}}"></i></sup>
            <a class="btn btn-success btn-sm addSensorCancelSecurity" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter un bouton}}</a>
          </legend>
          <div id="div_cancel_security"></div>
        </fieldset>
      </form>

      <br>

      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fas fa-hand-paper"></i> {{Actions pour arrêter l'alerte (pour annuler l'alerte, je dois ?)}} <sup><i class="fas fa-question-circle tooltips" title="{{Actions réalisées sur activation d'un bouton d'annulation d'alerte.
            Tag utilisable : #senior_name#.}}"></i></sup>
            <a class="btn btn-success btn-sm addAction" data-type="action_cancel_security" style="margin:5px;"><i class="fas fa-plus-circle"></i> {{Ajouter une action}}</a>
          </legend>
          <div id="div_action_cancel_security"></div>

        </fieldset>
      </form>

    </div>

    <!-- TAB COMMANDES -->
    <div role="tabpanel" class="tab-pane" id="commandtab">
      <!-- <a class="btn btn-success btn-sm cmdAction pull-right" data-action="add" style="margin-top:5px;"><i class="fa fa-plus-circle"></i> {{Commandes}}</a><br/><br/> -->
      <table id="table_cmd" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>{{Nom}}</th>
            <th>{{Type}}</th>
            <th>{{Paramètres}}</th>
            <th>{{Affichage dashboard}}</th>
            <th>{{Actions}}</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>


  </div> <!-- fin DIV contenant toutes les tab -->

</div>
</div>

<?php include_file('desktop', 'seniorcareconfortsecurity', 'js', 'seniorcareconfortsecurity');?>
<?php include_file('core', 'plugin.template', 'js');?>
