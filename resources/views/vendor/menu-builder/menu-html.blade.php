<?php
$currentUrl = url()->current();
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="{{ asset('dashboard/vendor/menu-builder/style.css') }}" rel="stylesheet">
<style>
    .autocomplete-container {
        position: relative;
        width: 300px;
        /* Sesuaikan dengan kebutuhan */
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .autocomplete-items {
        position: absolute;
        top: 100%;
        /* Letakkan tepat di bawah input */
        left: 0;
        right: 0;
        border: 1px solid #d4d4d4;
        border-top: none;
        z-index: 99;
        background-color: #fff;
        max-height: 200px;
        /* Batasi tinggi maksimum jika item terlalu banyak */
        overflow-y: auto;
        /* Tambahkan scroll jika terlalu banyak item */
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    .autocomplete-active {
        background-color: #0F4142 !important;
        color: #ffffff;
    }

    .description-thin {
        width: 90% !important;
    }

    .description-thin label,
    .description.description-wide label {
        width: 100% !important;
    }
</style>
<div id="hwpwrap">
    <div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
        <div id="wpwrap">
            <div id="wpcontent">
                <div id="wpbody">
                    <div id="wpbody-content">

                        <div class="wrap">

                            <div class="manage-menus" style="background-color: #0F4142!important;">
                                <form method="get" action="{{ $currentUrl }}">
                                    <label for="menu" class="selected-menu"
                                        style="color: white!important;">@lang('menu-builder::messages.select_menu_edit')</label>

                                    {!! Menu::select('menu', $menulist) !!}

                                    <span class="submit-btn">
                                        <input type="submit" class="button-secondary" value="@lang('menu-builder::messages.choose')">
                                    </span>
                                    {{-- <span class="add-new-menu-action" style="color: white!important;"> @lang("menu-builder::messages.or") <a href="{{ $currentUrl }}?action=edit&menu=0" style="color: rgba(129, 232, 248, 0.8);" >@lang("menu-builder::messages.create_new_menu")</a>. </span> --}}
                                </form>
                            </div>
                            <div id="nav-menus-frame">

                                @if (request()->has('menu') && !empty(request()->input('menu')))
                                    <div id="menu-settings-column" class="metabox-holder">

                                        <div class="clear"></div>

                                        <form id="nav-menu-meta" action="" class="nav-menu-meta" method="post"
                                            enctype="multipart/form-data">
                                            <div id="side-sortables" class="accordion-container">
                                                <ul class="outer-border">
                                                    <li class="control-section accordion-section open add-page"
                                                        id="add-page">
                                                        <h3 class="accordion-section-title hndle" tabindex="0">
                                                            @lang('menu-builder::messages.custom_link')
                                                            <span class="screen-reader-text">@lang('menu-builder::messages.press_enter')</span>
                                                        </h3>
                                                        <div class="accordion-section-content"
                                                            style="overflow: visible">
                                                            <div class="inside mt-0">
                                                                <div class="customlinkdiv" id="customlinkdiv">
                                                                    <p id="menu-item-url-wrap" class="mb-0">
                                                                        <label class="howto w-100"
                                                                            for="custom-menu-item-url">
                                                                            <span>{{ __('URL Type') }}</span>&nbsp;&nbsp;&nbsp;

                                                                            <div class="w-100 position-relative">
                                                                                <input id="external-url" type="radio"
                                                                                    name="url_type"
                                                                                    value="external url"> <label
                                                                                    for="external-url"class="me-2">{{ __('External Url') }}</label>
                                                                                <input id="page-url" value="page url"
                                                                                    type="radio" name="url_type">
                                                                                <label
                                                                                    for="page-url">{{ __('Page') }}</label>
                                                                            </div>
                                                                        </label>
                                                                    </p>
                                                                    <div class="d-none" id="url">

                                                                        <p id="menu-item-url-wrap" class="mb-0">
                                                                            <label class="howto w-100"
                                                                                for="custom-menu-item-url">
                                                                                <span>{{ __('URL') }}</span>&nbsp;&nbsp;&nbsp;

                                                                                <div
                                                                                    class="autocomplete w-100 position-relative">
                                                                                    <input id="autocompletePage"
                                                                                        type="text" class="d-none"
                                                                                        placeholder="{{ __('Type the External URL or Page Title') }}"
                                                                                        autocomplete="off">
                                                                                    <div id="autocomplete-list"
                                                                                        class="autocomplete-items ">
                                                                                    </div>
                                                                                    <input id="custom-menu-item-url"
                                                                                        name="url" type="text"
                                                                                        class="menu-item-textbox w-100 d-none"
                                                                                        placeholder="URL"
                                                                                        autocomplete="off" readonly>
                                                                                </div>
                                                                            </label>
                                                                        </p>
                                                                    </div>
                                                                    <p id="menu-item-name-wrap">
                                                                        <label class="howto w-100"
                                                                            for="custom-menu-item-name">
                                                                            <span>@lang('menu-builder::messages.label')</span>&nbsp;
                                                                            <input id="custom-menu-item-name"
                                                                                name="label" type="text"
                                                                                class="regular-text menu-item-textbox input-with-default-title w-100"
                                                                                autocomplete="off"
                                                                                title="@lang('menu-builder::messages.menu_label')">
                                                                        </label>
                                                                    </p>

                                                                    @if (!empty($roles))
                                                                        <p id="menu-item-role_id-wrap">
                                                                            <label class="howto"
                                                                                for="custom-menu-item-name">
                                                                                <span>@lang('menu-builder::messages.role')</span>&nbsp;
                                                                                <select id="custom-menu-item-role"
                                                                                    name="role">
                                                                                    <option value="0">
                                                                                        @lang('menu-builder::messages.select_role')</option>
                                                                                    @foreach ($roles as $role)
                                                                                        <option
                                                                                            value="{{ $role->$role_pk }}">
                                                                                            {{ ucfirst($role->$role_title_field) }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </label>
                                                                        </p>
                                                                    @endif

                                                                    <p class="button-controls">

                                                                        <a href="#" onclick="addcustommenu()"
                                                                            class="button-secondary submit-add-to-menu right">@lang('menu-builder::messages.add_menu_item')</a>
                                                                        <span class="spinner" id="spincustomu"></span>
                                                                    </p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </form>

                                    </div>
                                @endif
                                {{-- @if (request()->has('menu') && !empty(request()->input('menu'))) --}}
                                <div id="menu-management-liquid">
                                    <div id="menu-management">
                                        <form id="update-nav-menu" action="" method="post"
                                            enctype="multipart/form-data">
                                            <div class="menu-edit ">
                                                <div id="nav-menu-header">
                                                    <div class="major-publishing-actions">
                                                        <label class="menu-name-label howto open-label"
                                                            for="menu-name">
                                                            <span>@lang('menu-builder::messages.name')</span>
                                                            <input name="menu-name" id="menu-name" type="text"
                                                                class="menu-name regular-text menu-item-textbox"
                                                                title="@lang('menu-builder::messages.enter_menu_name')"
                                                                value="@if (isset($indmenu)) {{ $indmenu->name }} @endif"
                                                                >
                                                            <input type="hidden" id="idmenu"
                                                                value="@if (isset($indmenu)) {{ $indmenu->id }} @endif" />
                                                        </label>

                                                        @if (request()->has('action'))
                                                            <div class="publishing-action">
                                                                <a onclick="createnewmenu()" name="save_menu"
                                                                    id="save_menu_header"
                                                                    class="button button-primary menu-save">@lang('menu-builder::messages.create_menu')</a>
                                                            </div>
                                                        @elseif(request()->input('menu'))
                                                            <div class="publishing-action">
                                                                <a  name="save_menu"
                                                                    id="save_menu_header"
                                                                    class="button button-primary menu-save">@lang('menu-builder::messages.save_menu')</a>
                                                                <span class="spinner" id="spincustomu2"></span>
                                                            </div>
                                                        @else
                                                            <div class="publishing-action">
                                                                <a onclick="createnewmenu()" name="save_menu"
                                                                    id="save_menu_header"
                                                                    class="button button-primary menu-save">@lang('menu-builder::messages.create_menu')</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div id="post-body">
                                                    <div id="post-body-content">

                                                        @if (request()->input('menu'))
                                                            <h3>@lang('menu-builder::messages.menu_structure')</h3>
                                                            <div class="drag-instructions post-body-plain"
                                                                style="">
                                                                <p>
                                                                    @lang('menu-builder::messages.menu_structure_text')
                                                                </p>
                                                            </div>
                                                        @else
                                                            <h3>@lang('menu-builder::messages.menu_creation')</h3>
                                                            <div class="drag-instructions post-body-plain"
                                                                style="">
                                                                <p>
                                                                    @lang('menu-builder::messages.menu_creation_text')
                                                                </p>
                                                            </div>
                                                        @endif

                                                        <ul class="menu ui-sortable" id="menu-to-edit"
                                                            style="display: block;">
                                                            @if (isset($menus))
                                                                @foreach ($menus as $m)
                                                                    <li id="menu-item-{{ $m->id }}"
                                                                        class="menu-item menu-item-depth-{{ $m->depth }} menu-item-page menu-item-edit-inactive pending"
                                                                        style="display: list-item;">
                                                                        <dl class="menu-item-bar">
                                                                            <dt class="menu-item-handle">
                                                                                <span class="item-title"> <span
                                                                                        class="menu-item-title"> <span
                                                                                            id="menutitletemp_{{ $m->id }}">{{ __($m->label) }}</span>
                                                                                        <span
                                                                                            style="color: transparent;">|{{ $m->id }}|</span>
                                                                                    </span> <span class="is-submenu"
                                                                                        style="@if ($m->depth == 0) display: none; @endif">@lang('menu-builder::messages.subelement')</span>
                                                                                </span>
                                                                                <span class="item-controls"> <span
                                                                                        class="item-type">{{ __("Link") }}</span>
                                                                                    <span
                                                                                        class="item-order hide-if-js">
                                                                                        <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{ $m->id }}&_wpnonce=8b3eb7ac44"
                                                                                            class="item-move-up"><abbr>↑</abbr></a>
                                                                                        | <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{ $m->id }}&_wpnonce=8b3eb7ac44"
                                                                                            class="item-move-down"><abbr>↓</abbr></a>
                                                                                    </span> <a class="item-edit"
                                                                                        id="edit-{{ $m->id }}"
                                                                                        title=" "
                                                                                        href="{{ $currentUrl }}?edit-menu-item={{ $m->id }}#menu-item-settings-{{ $m->id }}">
                                                                                    </a> </span>
                                                                            </dt>
                                                                        </dl>

                                                                        <div class="menu-item-settings"
                                                                            id="menu-item-settings-{{ $m->id }}">
                                                                            <input type="hidden"
                                                                                class="edit-menu-item-id"
                                                                                name="menuid_{{ $m->id }}"
                                                                                value="{{ $m->id }}" />
                                                                            <p class="description description-thin">
                                                                                <label
                                                                                    for="edit-menu-item-title-{{ $m->id }}">
                                                                                    @lang('menu-builder::messages.label')
                                                                                    <br>
                                                                                    <input type="text"
                                                                                        id="idlabelmenu_{{ $m->id }}"
                                                                                        class="widefat edit-menu-item-title"
                                                                                        name="idlabelmenu_{{ $m->id }}"
                                                                                        value="{{ $m->label }}">
                                                                                </label>
                                                                            </p>

                                                                            <p
                                                                                class="field-css-classes description description-thin">
                                                                                <label
                                                                                    for="edit-menu-item-classes-{{ $m->id }}">
                                                                                    @lang('menu-builder::messages.class_css')
                                                                                    <br>
                                                                                    <input type="text"
                                                                                        id="clases_menu_{{ $m->id }}"
                                                                                        class="widefat code edit-menu-item-classes"
                                                                                        name="clases_menu_{{ $m->id }}"
                                                                                        value="{{ $m->class }}">
                                                                                </label>
                                                                            </p>

                                                                            <p
                                                                                class="field-css-url description description-wide">
                                                                                <label
                                                                                    for="edit-menu-item-url-{{ $m->id }}">
                                                                                    {{ __("URL") }}
                                                                                    <br>
                                                                                    <input type="text"
                                                                                        id="url_menu_{{ $m->id }}"
                                                                                        class="widefat code edit-menu-item-url"
                                                                                        id="url_menu_{{ $m->id }}"
                                                                                        value="{{ $m->link }}">
                                                                                </label>
                                                                            </p>

                                                                            @if (!empty($roles))
                                                                                <p
                                                                                    class="field-css-role description description-wide">
                                                                                    <label
                                                                                        for="edit-menu-item-role-{{ $m->id }}">
                                                                                        @lang('menu-builder::messages.role')
                                                                                        <br>
                                                                                        <select
                                                                                            id="role_menu_{{ $m->id }}"
                                                                                            class="widefat code edit-menu-item-role"
                                                                                            name="role_menu_[{{ $m->id }}]">
                                                                                            <option value="0">
                                                                                                @lang('menu-builder::messages.select_url')
                                                                                            </option>
                                                                                            @foreach ($roles as $role)
                                                                                                <option
                                                                                                    @if ($role->id == $m->role_id) selected @endif
                                                                                                    value="{{ $role->$role_pk }}">
                                                                                                    {{ ucwords($role->$role_title_field) }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </label>
                                                                                </p>
                                                                            @endif

                                                                            <p
                                                                                class="field-move hide-if-no-js description description-wide">

                                                                            </p>

                                                                            <div
                                                                                class="menu-item-actions description-wide submitbox">

                                                                                <a class="item-delete submitdelete deletion"
                                                                                    id="delete-{{ $m->id }}"
                                                                                    href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{ $m->id }}&_wpnonce=2844002501">@lang('menu-builder::messages.delete')</a>
                                                                                <span class="meta-sep hide-if-no-js"> |
                                                                                </span>
                                                                                <a class="item-cancel submitcancel hide-if-no-js button-secondary"
                                                                                    id="cancel-{{ $m->id }}"
                                                                                    href="{{ $currentUrl }}?edit-menu-item={{ $m->id }}&cancel=1424297719#menu-item-settings-{{ $m->id }}">@lang('menu-builder::messages.cancel')</a>
                                                                                <span class="meta-sep hide-if-no-js"> |
                                                                                </span>
                                                                                <a onclick="getmenus(this)"
                                                                                    class="button button-primary updatemenu"
                                                                                    id="update-{{ $m->id }}"
                                                                                    href="javascript:void(0)"
                                                                                    data-id="{{ $m->id }}">@lang('menu-builder::messages.update_item')</a>

                                                                            </div>

                                                                        </div>
                                                                        <ul class="menu-item-transport"></ul>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                        <div class="menu-settings">

                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="nav-menu-footer">
                                                    <div class="major-publishing-actions">

                                                        @if (request()->has('action'))
                                                            <div class="publishing-action">
                                                                <a onclick="createnewmenu()" name="save_menu"
                                                                    id="save_menu_header"
                                                                    class="button button-primary menu-save">@lang('menu-builder::messages.create_menu')</a>
                                                            </div>
                                                        @elseif(request()->input('menu'))
                                                            <span class="delete-action"> <a
                                                                    class="submitdelete deletion menu-delete"
                                                                    onclick="deletemenu()"
                                                                    href="javascript:void(9)">@lang('menu-builder::messages.delete_menu')</a>
                                                            </span>
                                                            
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const autocompletePage = document.getElementById('autocompletePage');
            // Event listener untuk radio buttons
            document.querySelectorAll('input[name="url_type"]').forEach((elem) => {
                elem.addEventListener('change', function() {
                    const autocompletePage = document.getElementById('autocompletePage');
                    const customMenuItemUrl = document.getElementById('custom-menu-item-url');
                    const urlDiv = document.getElementById('url');

                    // Tampilkan div URL jika salah satu radio button dipilih
                    urlDiv.classList.remove('d-none');

                    if (this.value == 'page url') {
                        // Jika 'Page URL' dipilih, tampilkan autocomplete dan sembunyikan custom URL
                        autocompletePage.classList.remove('d-none');
                        customMenuItemUrl.classList.add('d-none');
                        customMenuItemUrl.setAttribute('readonly',
                        true); // Tetap readonly untuk 'page url'
                    } else if (this.value == 'external url') {
                        // Jika 'External URL' dipilih, tampilkan custom URL dan sembunyikan autocomplete
                        autocompletePage.classList.add('d-none');
                        customMenuItemUrl.classList.remove('d-none');
                        customMenuItemUrl.removeAttribute('readonly');
                    }
                });
            });





            function autocomplete(input, items) {
                let currentFocus;
                input.addEventListener("input", function() {
                    let list = document.getElementById("autocomplete-list");
                    let val = this.value;

                    // Bersihkan item yang lama
                    list.innerHTML = '';
                    if (!val) return false;
                    currentFocus = -1;

                    // Buat elemen autocomplete berdasarkan input
                    items.forEach(function(item) {
                        if (item.title.substr(0, val.length).toUpperCase() === val.toUpperCase()) {
                            let itemDiv = document.createElement("div");
                            itemDiv.innerHTML = "<strong>" + item.title.substr(0, val.length) +
                                "</strong>";
                            itemDiv.innerHTML += item.title.substr(val.length);
                            itemDiv.innerHTML += "<input type='hidden' value='" + item.title +
                                "'><input type='hidden' name='slug' value='" + item.slug + "'>";

                            itemDiv.addEventListener("click", function() {
                                input.value = this.getElementsByTagName("input")[0].value;
                                list.innerHTML = ''; // Bersihkan daftar setelah klik

                                if (this.querySelector("[name=slug]").value ==
                                    "url-custom") {
                                    $("#custom-menu-item-url").prop("readonly",
                                        false); // Pastikan menggunakan prop()
                                    $("#custom-menu-item-url").val("");
                                } else {
                                    var url = `/${this.querySelector("[name=slug]").value}`;
                                    $("#custom-menu-item-url").prop("readonly", true);
                                    $("#custom-menu-item-url").val(url);
                                }
                            });

                            list.appendChild(itemDiv);
                        }
                    });
                });


                input.addEventListener("keydown", function(e) {
                    let x = document.getElementById("autocomplete-list").getElementsByTagName("div");
                    if (e.keyCode === 40) { // Arrow down
                        currentFocus++;
                        addActive(x);
                    } else if (e.keyCode === 38) { // Arrow up
                        currentFocus--;
                        addActive(x);
                    } else if (e.keyCode === 13) { // Enter
                        e.preventDefault();
                        if (currentFocus > -1 && x[currentFocus]) {
                            x[currentFocus].click();
                        }
                    }
                });

                function addActive(x) {
                    if (!x) return false;
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = x.length - 1;
                    x[currentFocus].classList.add("autocomplete-active");
                }

                function removeActive(x) {
                    for (let i = 0; i < x.length; i++) {
                        x[i].classList.remove("autocomplete-active");
                    }
                }
            }

            const pages = @json(getPage());
            autocomplete(document.getElementById("autocompletePage"), pages);
            // autocomplete(document.getElementsByClassName("edit-menu-item-url")[0], countries);
        });
    </script>
@endpush
