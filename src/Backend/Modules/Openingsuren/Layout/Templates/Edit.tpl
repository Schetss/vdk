{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblOpeningsuren|ucfirst}: {$lblEdit}</h2>
</div>

{form:edit}
    <label for="naam">Naam</label>
    {$txtNaam} {$txtNaamError}

    <div id="pageUrl">
      <!--   <div class="oneLiner">
            {option:detailURL}<p><span><a href="{$detailURL}/{$item.url}">{$detailURL}/<span id="generatedUrl">{$item.url}</span></a></span></p>{/option:detailURL}
            {option:!detailURL}<p class="infoMessage">{$errNoModuleLinked}</p>{/option:!detailURL}
        </div> -->
    </div>


    <div class="tabs">
        <ul>
            <li><a href="#tabContent">{$lblContent|ucfirst}</a></li>
            <li><a href="#tabSEO">{$lblSEO|ucfirst}</a></li>
        </ul>

        <div id="tabContent">
            <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td id="leftColumn">

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="maandagvoormiddagOpen">Maandag</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtMaandagvoormiddagOpen} {$txtMaandagvoormiddagOpenError} -
                                 {$txtMaandagvoormiddagSluit} {$txtMaandagvoormiddagSluitError}
                            </div>
                             <div class="options">
                                {$txtMaandagnamiddagOpen} {$txtMaandagnamiddagOpenError} -
                                 {$txtMaandagnamiddagSluit} {$txtMaandagnamiddagSluitError}
                            </div>
                            <div class="options">
                                {$chkMaandagOpen} <label for="maandagOpen">Wij zijn maandag open </label> {$chkMaandagOpenError}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="dinsdagvoormiddagOpen">Dinsdag</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtDinsdagvoormiddagOpen} {$txtDinsdagvoormiddagOpenError}
                                -
                                 {$txtDinsdagvoormiddagSluit} {$txtDinsdagvoormiddagSluitError}
                            </div>
                              <div class="options">
                                {$txtDinsdagnamiddagOpen} {$txtDinsdagnamiddagOpenError}
                                -
                                {$txtDinsdagnamiddagSluit} {$txtDinsdagnamiddagSluitError}
                            </div>
                              <div class="options">
                                {$chkDinsdagOpen} <label for="dinsdagOpen">Wij zijn dinsdag open </label> {$chkDinsdagOpenError}
                            </div>
                        </div>

                        
                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="woensdagvoormiddagOpen">Woensdag</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtWoensdagvoormiddagOpen} {$txtWoensdagvoormiddagOpenError}
                                -
                                  {$txtWoensdagvoormiddagSluit} {$txtWoensdagvoormiddagSluitError}
                            </div>
                             <div class="options">
                                {$txtWoensdagnamiddagOpen} {$txtWoensdagnamiddagOpenError}
                                -
                                 {$txtWoensdagnamiddagSluit} {$txtWoensdagnamiddagSluitError}
                            </div>
                             <div class="options">
                                {$chkWoensdagOpen} <label for="woensdagOpen">Wij zijn woensdag open </label> {$chkWoensdagOpenError}
                            </div>
                        </div>


                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="donderdagvoormiddagOpen">Donderdag</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtDonderdagvoormiddagOpen} {$txtDonderdagvoormiddagOpenError}
                                -
                                 {$txtDonderdagvoormiddagSluit} {$txtDonderdagvoormiddagSluitError}
                            </div>
                            <div class="options">
                                {$txtDonderdagnamiddagOpen} {$txtDonderdagnamiddagOpenError}
                                -
                                {$txtDonderdagnamiddagSluit} {$txtDonderdagnamiddagSluitError}
                            </div>
                            <div class="options">
                                {$chkDonderdagOpen} <label for="donderdagOpen">Wij zijn donderdag open </label> {$chkDonderdagOpenError}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="vrijdagvoormiddagOpen">Vrijdag</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtVrijdagvoormiddagOpen} {$txtVrijdagvoormiddagOpenError}
                                -
                                {$txtVrijdagvoormiddagSluit} {$txtVrijdagvoormiddagSluitError}
                            </div>
                              <div class="options">
                                {$txtVrijdagnamiddagOpen} {$txtVrijdagnamiddagOpenError}
                                -
                                 {$txtVrijdagnamiddagSluit} {$txtVrijdagnamiddagSluitError}
                            </div>
                            <div class="options">
                                {$chkVrijdagOpen} <label for="vrijdagOpen">Wij zijn vrijdag open </label> {$chkVrijdagOpenError}
                            </div>
                        </div>


                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="zaterdagvoormiddagOpen">Zaterdag</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtZaterdagvoormiddagOpen} {$txtZaterdagvoormiddagOpenError}
                                -
                                 {$txtZaterdagvoormiddagSluit} {$txtZaterdagvoormiddagSluitError}
                            </div>
                             <div class="options">
                                {$txtZaterdagnamiddagOpen} {$txtZaterdagnamiddagOpenError}
                                -
                                 {$txtZaterdagnamiddagSluit} {$txtZaterdagnamiddagSluitError}
                            </div>
                            <div class="options">
                                {$chkZaterdagOpen} <label for="zaterdagOpen">Wij zijn zaterdag open </label> {$chkZaterdagOpenError}
                            </div>
                        </div>

                       
                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="zondagvoormiddagOpen">Zondag</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtZondagvoormiddagOpen} {$txtZondagvoormiddagOpenError}
                                -
                                 {$txtZondagvoormiddagSluit} {$txtZondagvoormiddagSluitError}
                            </div>
                            <div class="options">
                                {$txtZondagnamiddagOpen} {$txtZondagnamiddagOpenError}
                                -
                                 {$txtZondagnamiddagSluit} {$txtZondagnamiddagSluitError}
                            </div>
                             <div class="options">
                                {$chkZondagOpen} <label for="zondagOpen">Wij zijn zondag open </label> {$chkZondagOpenError}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="sluitingsdagen">Onze sluitingsdagen</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtSluitingsdagen} {$txtSluitingsdagenError}
                            </div>
                        </div>


                    </td>

                    <td id="sidebar">

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        Gesloten
                                    </h3>
                                </div>
                                <div class="options">
                                    {$chkWijZijnOpVakantie} <label for="wijZijnOpVakantie">Wij zijn gesloten!</label> {$chkWijZijnOpVakantieError}
                                </div>
                            </div>

                            

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        <label for="categoryId">Categorie</label>
                                    </h3>
                                </div>
                                <div class="options">
                                    {$ddmCategoryId} {$ddmCategoryIdError}
                                </div>
                            </div>


                    </td>
                </tr>
            </table>
        </div>

        <div id="tabSEO">
            {include:{$BACKEND_CORE_PATH}/Layout/Templates/Seo.tpl}
        </div>

    </div>

    <div class="fullwidthOptions">
        <a href="{$var|geturl:'delete'}&amp;id={$item.id}" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
            <span>{$lblDelete|ucfirst}</span>
        </a>
        <div class="buttonHolderRight">
            <input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblSave|ucfirst}" />
        </div>
    </div>

    <div id="confirmDelete" title="{$lblDelete|ucfirst}?" style="display: none;">
        <p>
            {$msgConfirmDelete|sprintf:{$item.title}}
        </p>
    </div>
{/form:edit}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
