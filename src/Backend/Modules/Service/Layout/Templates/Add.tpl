{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblService|ucfirst}: {$lblAdd}</h2>
</div>

{form:add}
    <label for="titel">{$lblTitel|ucfirst}</label>
    {$txtTitel} {$txtTitelError}

    <div id="pageUrl">
        <div class="oneLiner">
            {option:detailURL}<p><span><a href="{$detailURL}{option:item}/{$item.url}{/option:item}">{$detailURL}/<span id="generatedUrl"></span></a></span></p>{/option:detailURL}
            {option:!detailURL}<p class="infoMessage">{$errNoModuleLinked}</p>{/option:!detailURL}
        </div>
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
                                    <label for="tekst">{$lblTekst|ucfirst}</label>
                                </h3>
                            </div>
                            <div class="optionsRTE">
                                {$txtTekst} {$txtTekstError}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="link">{$lblLink|ucfirst}</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtLink} {$txtLinkError}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="linktekst">{$lblLinktekst|ucfirst}</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtLinktekst} {$txtLinktekstError}
                            </div>
                        </div>


                    </td>

                    <td id="sidebar">

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        {$lblPubliceren|ucfirst}
                                    </h3>
                                </div>
                                <div class="options">
                                    {$chkPubliceren} <label for="publiceren">{$lblPubliceren|ucfirst} </label> {$chkPublicerenError}
                                </div>
                            </div>

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        <label for="afbeelding">{$lblAfbeelding|ucfirst}</label>
                                    </h3>
                                </div>
                                <div class="options">
                                    {$fileAfbeelding} {$fileAfbeeldingError}
                                </div>
                            </div>

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        <label for="tags">{$lblTags|ucfirst}</label>
                                    </h3>
                                </div>
                                <div class="options">
                                    {$txtTags} {$txtTagsError}
                                </div>
                            </div>

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        <label for="categoryId">{$lblCategory|ucfirst}</label>
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
        <div class="buttonHolderRight">
            <input id="addButton" class="inputButton button mainButton" type="submit" name="add" value="{$lblPublish|ucfirst}" />
        </div>
    </div>
{/form:add}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}