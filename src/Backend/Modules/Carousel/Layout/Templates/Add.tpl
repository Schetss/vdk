{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
    <h2>{$lblCarousel|ucfirst}: {$lblAdd}</h2>
</div>

{form:add}
    <label for="titel">Titel</label>
    {$txtTitel} {$txtTitelError}

    <div id="pageUrl">
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
                                    <label for="subtitel">Subtitel</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtSubtitel} {$txtSubtitelError}
                            </div>
                        </div>

                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="link">Link</label>
                                </h3>
                            </div>
                            <div class="options">
                                {$txtLink}
                            </div>
                        </div>
                        <div class="box">
                            <div class="heading">
                                <h3>
                                    <label for="afbeelding">Afbeelding<abbr title="{$lblRequiredField}">*</abbr></label>
                                </h3>
                            </div>
                            <div class="options">
                                {$fileAfbeelding} {$fileAfbeeldingError}
                            </div>
                        </div>



                    </td>

                    <td id="sidebar">

                            

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                       Tonen in carousel
                                    </h3>
                                </div>
                                <div class="options">
                                    {$chkToonDitBericht} <label for="toonDitBericht">Afspelen </label> {$chkToonDitBerichtError}
                                </div>
                            </div>

                            <div class="box">
                                <div class="heading">
                                    <h3>
                                        <label for="tags">{$lblTags|ucfirst} (optioneel)</label>
                                    </h3>
                                </div>
                                <div class="options">
                                    {$txtTags} {$txtTagsError}
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
