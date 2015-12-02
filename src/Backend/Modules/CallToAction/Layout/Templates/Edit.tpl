{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblCallToAction|ucfirst}: {$lblEdit}</h2>
</div>

{form:edit}
    <label for="titel">{$lblTitel|ucfirst}</label>
    {$txtTitel} {$txtTitelError}

    <div id="pageUrl">
        <div class="oneLiner">
            {option:detailURL}<p><span><a href="{$detailURL}/{$item.url}">{$detailURL}/<span id="generatedUrl">{$item.url}</span></a></span></p>{/option:detailURL}
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
                                        <label for="afbeelding">{$lblAfbeelding|ucfirst}</label>
                                    </h3>
                                </div>
                                <div class="options">
                                    {option:item.afbeelding}
                                        <p><img src="{$FRONTEND_FILES_URL}/call_to_action/afbeelding/400x300/{$item.afbeelding}"/></p>
                                    {/option:item.afbeelding}
                                    <p>
                                        {$fileAfbeelding} {$fileAfbeeldingError}
                                    </p>
                                </div>
                            </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="text">{$lblText|ucfirst}</label>
                                </h3>
                            </div>
                            <div class="optionsRTE">
                                {$txtText} {$txtTextError}
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
