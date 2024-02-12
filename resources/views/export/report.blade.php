@php
    $appCss = env('APP_URL') . '/dist/css/report_styles/report.css';
    $qlCss = env('APP_URL') . '/dist/css/report_styles/ql.css';
    $appBrand = public_path('storage\assets\brand.png');
    $bnaLogo = public_path('storage\assets\bna_logo.svg');
    $coverPageImg = public_path('storage\assets\report_cover_page.jpg');
    $appBrandMonochrome = public_path('storage\assets\brand_monochrome.png');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ $appBrand }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ $appCss }}">
    <link rel="stylesheet" href="{{ $qlCss }}">
    <title>Rapport de la mission {{ $mission->reference }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Verdana, Geneva, Tahoma, sans-serif
        }

        body {
            padding-top: 250px;
            padding-bottom: 200px;
            font-size: 42px;
        }

        .page-break-after-always {
            page-break-after: always;
        }

        .page-break-after-auto {
            page-break-after: auto;
        }

        .page-break-before-always {
            page-break-before: always;
        }

        .page-break-before-auto {
            page-break-before: auto;
        }

        .page {
            position: relative;
            width: 100%;
            height: auto;
            padding: 0;
            margin: 0;
        }

        ul {
            margin: 0 0 0 1em;
            padding: 0;
        }

        .campaign-introduction {
            text-align: justify;
            margin: 10px;
        }

        .no-padding {
            padding: 0 !important;
        }

        .cover-page-img {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            object-fit: cover;
            margin-top: -250px;
        }

        .power-control-monochrome {
            /* color: white; */
            height: 136px;
            position: absolute;
            bottom: -100px;
            left: 50%;
            transform: translateX(-50%);
        }

        .cover-page-logo {
            position: absolute;
            top: -100px;
            left: 166px;
            height: 163px;
        }

        .first-section-text {
            position: absolute;
            font-family: Tahoma;
            font-size: 34px;
            /* top: 344.01px; */
            top: 94.01px;
            left: 164.59px;
        }

        .first-section-text p {
            margin-bottom: 10px;
        }

        .second-section-text {
            position: absolute;
            left: 43px;
            right: -43px;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
        }

        .campaign-informations {
            position: absolute;
            left: 135.18px;
            /* top: 1760.36px; */
            top: 1510.36px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 90px;
        }

        .year {
            position: absolute;
            left: 2024.28px;
            /* top: 1743.24px; */
            top: 1493.24px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 144px;
            font-weight: bold;
            color: #fcfcfc;
        }

        .report-title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: absolute;
            left: 1880px;
            /* top: 2500px; */
            top: 2250px;
            transform: translateY(-50%);
            color: #fcfcfc;
            font-size: 90px;
        }

        .report-title b {
            letter-spacing: 15px;
        }

        .box {
            background-color: #009891;
            height: 111px;
            color: #fcfcfc;
            font-weight: bold;
            padding: 20px 40px;
        }

        .box.agency {
            position: absolute;
            left: 1100px;
            /* top: 2650px; */
            top: 2400px;
            width: 100%;
            font-size: 80px;
        }

        .box.agency .reference {
            font-weight: normal;
            position: absolute;
            bottom: -80px;
            font-size: 60px;
        }

        .box.agency .date {
            font-weight: normal;
            position: absolute;
            bottom: -80px;
            font-size: 60px;
            left: 30%;
        }

        .box.agency .date.with-month {
            left: 27%;
        }

        .box.agency .date.with-year {
            left: 22%;
        }

        .controlled_by,
        .validated_by,
        .assisted_by {
            position: absolute;
            left: 450px;
            bottom: -130px;
            height: 70px;
            width: auto;
            font-size: 50px;
            color: #fcfcfc;
            font-weight: normal;
            position: absolute;
        }

        .validated_by {
            top: 2700px;
        }

        .controlled_by {
            top: 2780px;
        }

        .assisted_by {
            top: 2860px;
        }


        .page-header {
            position: fixed;
            top: 0;
            left: 0px;
            right: 0px;
            height: 200px;
            /* background-color: red; */

            /** Extra personal styles **/
            /* background-color: #03a9f4; */
            vertical-align: middle;
        }

        .page-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 80%;
            /* height: 1px; */
            height: 0.03cm;
            transform: translateX(-50%);
            background-color: #b18028;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -.07cm;
            right: 10%;
            width: 1.25cm;
            /* height: 1px; */
            height: 0.09cm;
            transform: translateY(-50%);
            background-color: #056551;
        }

        .page-header .bna-logo {
            position: absolute;
            top: 50%;
            /* left: 20%; */
            transform: translateY(-50%);

            height: 120px;
            /* height: 1.07cm; */
        }

        .page-header .text-content {
            position: absolute;
            right: 0;
            top: 50%;
            /* left: 20%; */
            transform: translateY(-50%);
            text-align: right;
            font-size: 36px;
        }

        .page-footer {
            position: fixed;
            bottom: 0;
            left: 0px;
            right: 0px;
            height: 200px;

            color: white;
            line-height: 35px;
        }

        .page-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 80%;
            /* height: 1px; */
            height: 0.03cm;
            transform: translateX(-50%);
            background-color: #b18028;
        }

        .page-footer::after {
            content: '';
            position: absolute;
            top: .01cm;
            right: 10%;
            width: 1.25cm;
            /* height: 1px; */
            height: 0.09cm;
            transform: translateY(-50%);
            background-color: #056551;
        }

        .page-footer .app-brand {
            position: absolute;
            top: 50%;
            /* left: 20%; */
            transform: translateY(-50%);

            /* height: 32px; */
            height: 1.07cm;
        }

        .page-body {
            /* background-color: red; */
            padding-top: 20px;
            padding-bottom: 10px;
            /* page-break-after: always; */
            /* width: 95%;
                margin: 0 auto; */
        }

        .table-container {
            position: relative;
            margin: 40px 0;
            width: 100%;
            page-break-before: auto
        }

        table {
            position: relative;
            display: table;
            border: 2px solid #BFBFBF;
            width: 100%;
            page-break-before: auto;
            border-spacing: 0;
            font-size: 42px;
        }

        caption {
            margin-top: 10px;
            border: 1px solid #BFBFBF;
            border-bottom: none;
            padding: 10px 8px;
            font-size: 42px;
            page-break-after: avoid;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        caption.is-success {
            background-color: #125741;
            color: #fcfcfc;
        }

        caption.is-danger {
            background-color: #CC0000;
            color: #fcfcfc;
        }

        caption.is-anomaly {
            background-color: #ffbb33;
            color: #000000;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: avoid;
        }

        tr:last-child {
            border: none !important;
        }

        tr.metadata-row td,
        tr.metadata-row th {
            text-align: left;
            position: relative;
            border: none;
            /* width: 100%; */
            /* white-space: pre-wrap; */
        }

        tr.metadata-row th {
            /* max-width: 200px; */
            /* background-color: red; */
            vertical-align: text-top;
        }

        tr.metadata-row td {
            /* background-color: yellow; */
            text-align: justify;
            white-space: wrap;
            max-width: 100%;
        }

        tr.metadata-row.border-bottom td,
        tr.metadata-row.border-bottom th {
            border-bottom: 1px solid #BFBFBF;
        }

        .margin-cell {
            width: 5px !important;
            max-width: 5px !important;
        }

        .metadata-row .margin-cell {
            border: none !important
        }

        .metadata-row.border-bottom:last-child {
            border: none !important
        }

        th {
            text-align: left;
            width: 20%;
            border-bottom: 1px solid #BFBFBF;
            /* border-right: 1px solid #BFBFBF; */
            white-space: nowrap;
        }

        td {
            text-align: justify;
            width: 100%;
            border-bottom: 1px solid #BFBFBF;
            border-left: 1px solid #BFBFBF;
        }

        th,
        td {
            padding: 10px 20px;
        }

        th {
            vertical-align: text-top;
        }

        .text-danger {
            color: #CC0000;
        }

        .bg-gray {
            background: #BFBFBF;
        }

        .container {
            position: relative;
            width: 80%;
            margin: 0 auto;
        }

        .container.is-fluid {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .report-area {
            line-height: 1.5
        }


        .table-of-content a {
            color: #000000;
            text-decoration: none;
        }

        .img-container {
            position: relative;
            display: block;
            width: 100%;
            margin: 10px auto;
        }

        .img {
            width: 100%;
            /* max-width: 400px; */
            height: auto;
            margin: 10px auto;
        }
    </style>
    <style>
        /*!
        * Quill Editor v1.3.7
        * https://quilljs.com/
        * Copyright (c) 2014, Jason Chen
        * Copyright (c) 2013, salesforce.com
        */
        .ql-container {
            box-sizing: border-box;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 13px;
            height: 100%;
            margin: 0px;
            position: relative;
        }

        .ql-container.ql-disabled .ql-tooltip {
            visibility: hidden;
        }

        .ql-container.ql-disabled .ql-editor ul[data-checked]>li::before {
            pointer-events: none;
        }

        .ql-clipboard {
            left: -100000px;
            height: 1px;
            overflow-y: hidden;
            position: absolute;
            top: 50%;
        }

        .ql-clipboard p {
            margin: 0;
            padding: 0;
        }

        .ql-editor {
            box-sizing: border-box;
            line-height: 1.42;
            height: 100%;
            outline: none;
            overflow-y: auto;
            padding: 12px 15px;
            tab-size: 4;
            -moz-tab-size: 4;
            text-align: left;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .ql-editor>* {
            cursor: text;
        }

        .ql-editor p,
        .ql-editor ol,
        .ql-editor ul,
        .ql-editor pre,
        .ql-editor blockquote,
        .ql-editor h1,
        .ql-editor h2,
        .ql-editor h3,
        .ql-editor h4,
        .ql-editor h5,
        .ql-editor h6 {
            margin: 0;
            padding: 0;
            counter-reset: list-1 list-2 list-3 list-4 list-5 list-6 list-7 list-8 list-9;
        }

        .ql-editor ol,
        .ql-editor ul {
            padding-left: 1.5em;
        }

        .ql-editor ol>li,
        .ql-editor ul>li {
            list-style-type: none;
        }

        .ql-editor ul>li::before {
            content: '\2022';
        }

        .ql-editor ul[data-checked=true],
        .ql-editor ul[data-checked=false] {
            pointer-events: none;
        }

        .ql-editor ul[data-checked=true]>li *,
        .ql-editor ul[data-checked=false]>li * {
            pointer-events: all;
        }

        .ql-editor ul[data-checked=true]>li::before,
        .ql-editor ul[data-checked=false]>li::before {
            color: #777;
            cursor: pointer;
            pointer-events: all;
        }

        .ql-editor ul[data-checked=true]>li::before {
            content: '\2611';
        }

        .ql-editor ul[data-checked=false]>li::before {
            content: '\2610';
        }

        .ql-editor li::before {
            display: inline-block;
            white-space: nowrap;
            width: 1.2em;
        }

        .ql-editor li:not(.ql-direction-rtl)::before {
            margin-left: -1.5em;
            margin-right: 0.3em;
            text-align: right;
        }

        .ql-editor li.ql-direction-rtl::before {
            margin-left: 0.3em;
            margin-right: -1.5em;
        }

        .ql-editor ol li:not(.ql-direction-rtl),
        .ql-editor ul li:not(.ql-direction-rtl) {
            padding-left: 1.5em;
        }

        .ql-editor ol li.ql-direction-rtl,
        .ql-editor ul li.ql-direction-rtl {
            padding-right: 1.5em;
        }

        .ql-editor ol li {
            counter-reset: list-1 list-2 list-3 list-4 list-5 list-6 list-7 list-8 list-9;
            counter-increment: list-0;
        }

        .ql-editor ol li:before {
            content: counter(list-0, decimal) '. ';
        }

        .ql-editor ol li.ql-indent-1 {
            counter-increment: list-1;
        }

        .ql-editor ol li.ql-indent-1:before {
            content: counter(list-1, lower-alpha) '. ';
        }

        .ql-editor ol li.ql-indent-1 {
            counter-reset: list-2 list-3 list-4 list-5 list-6 list-7 list-8 list-9;
        }

        .ql-editor ol li.ql-indent-2 {
            counter-increment: list-2;
        }

        .ql-editor ol li.ql-indent-2:before {
            content: counter(list-2, lower-roman) '. ';
        }

        .ql-editor ol li.ql-indent-2 {
            counter-reset: list-3 list-4 list-5 list-6 list-7 list-8 list-9;
        }

        .ql-editor ol li.ql-indent-3 {
            counter-increment: list-3;
        }

        .ql-editor ol li.ql-indent-3:before {
            content: counter(list-3, decimal) '. ';
        }

        .ql-editor ol li.ql-indent-3 {
            counter-reset: list-4 list-5 list-6 list-7 list-8 list-9;
        }

        .ql-editor ol li.ql-indent-4 {
            counter-increment: list-4;
        }

        .ql-editor ol li.ql-indent-4:before {
            content: counter(list-4, lower-alpha) '. ';
        }

        .ql-editor ol li.ql-indent-4 {
            counter-reset: list-5 list-6 list-7 list-8 list-9;
        }

        .ql-editor ol li.ql-indent-5 {
            counter-increment: list-5;
        }

        .ql-editor ol li.ql-indent-5:before {
            content: counter(list-5, lower-roman) '. ';
        }

        .ql-editor ol li.ql-indent-5 {
            counter-reset: list-6 list-7 list-8 list-9;
        }

        .ql-editor ol li.ql-indent-6 {
            counter-increment: list-6;
        }

        .ql-editor ol li.ql-indent-6:before {
            content: counter(list-6, decimal) '. ';
        }

        .ql-editor ol li.ql-indent-6 {
            counter-reset: list-7 list-8 list-9;
        }

        .ql-editor ol li.ql-indent-7 {
            counter-increment: list-7;
        }

        .ql-editor ol li.ql-indent-7:before {
            content: counter(list-7, lower-alpha) '. ';
        }

        .ql-editor ol li.ql-indent-7 {
            counter-reset: list-8 list-9;
        }

        .ql-editor ol li.ql-indent-8 {
            counter-increment: list-8;
        }

        .ql-editor ol li.ql-indent-8:before {
            content: counter(list-8, lower-roman) '. ';
        }

        .ql-editor ol li.ql-indent-8 {
            counter-reset: list-9;
        }

        .ql-editor ol li.ql-indent-9 {
            counter-increment: list-9;
        }

        .ql-editor ol li.ql-indent-9:before {
            content: counter(list-9, decimal) '. ';
        }

        .ql-editor .ql-indent-1:not(.ql-direction-rtl) {
            padding-left: 3em;
        }

        .ql-editor li.ql-indent-1:not(.ql-direction-rtl) {
            padding-left: 4.5em;
        }

        .ql-editor .ql-indent-1.ql-direction-rtl.ql-align-right {
            padding-right: 3em;
        }

        .ql-editor li.ql-indent-1.ql-direction-rtl.ql-align-right {
            padding-right: 4.5em;
        }

        .ql-editor .ql-indent-2:not(.ql-direction-rtl) {
            padding-left: 6em;
        }

        .ql-editor li.ql-indent-2:not(.ql-direction-rtl) {
            padding-left: 7.5em;
        }

        .ql-editor .ql-indent-2.ql-direction-rtl.ql-align-right {
            padding-right: 6em;
        }

        .ql-editor li.ql-indent-2.ql-direction-rtl.ql-align-right {
            padding-right: 7.5em;
        }

        .ql-editor .ql-indent-3:not(.ql-direction-rtl) {
            padding-left: 9em;
        }

        .ql-editor li.ql-indent-3:not(.ql-direction-rtl) {
            padding-left: 10.5em;
        }

        .ql-editor .ql-indent-3.ql-direction-rtl.ql-align-right {
            padding-right: 9em;
        }

        .ql-editor li.ql-indent-3.ql-direction-rtl.ql-align-right {
            padding-right: 10.5em;
        }

        .ql-editor .ql-indent-4:not(.ql-direction-rtl) {
            padding-left: 12em;
        }

        .ql-editor li.ql-indent-4:not(.ql-direction-rtl) {
            padding-left: 13.5em;
        }

        .ql-editor .ql-indent-4.ql-direction-rtl.ql-align-right {
            padding-right: 12em;
        }

        .ql-editor li.ql-indent-4.ql-direction-rtl.ql-align-right {
            padding-right: 13.5em;
        }

        .ql-editor .ql-indent-5:not(.ql-direction-rtl) {
            padding-left: 15em;
        }

        .ql-editor li.ql-indent-5:not(.ql-direction-rtl) {
            padding-left: 16.5em;
        }

        .ql-editor .ql-indent-5.ql-direction-rtl.ql-align-right {
            padding-right: 15em;
        }

        .ql-editor li.ql-indent-5.ql-direction-rtl.ql-align-right {
            padding-right: 16.5em;
        }

        .ql-editor .ql-indent-6:not(.ql-direction-rtl) {
            padding-left: 18em;
        }

        .ql-editor li.ql-indent-6:not(.ql-direction-rtl) {
            padding-left: 19.5em;
        }

        .ql-editor .ql-indent-6.ql-direction-rtl.ql-align-right {
            padding-right: 18em;
        }

        .ql-editor li.ql-indent-6.ql-direction-rtl.ql-align-right {
            padding-right: 19.5em;
        }

        .ql-editor .ql-indent-7:not(.ql-direction-rtl) {
            padding-left: 21em;
        }

        .ql-editor li.ql-indent-7:not(.ql-direction-rtl) {
            padding-left: 22.5em;
        }

        .ql-editor .ql-indent-7.ql-direction-rtl.ql-align-right {
            padding-right: 21em;
        }

        .ql-editor li.ql-indent-7.ql-direction-rtl.ql-align-right {
            padding-right: 22.5em;
        }

        .ql-editor .ql-indent-8:not(.ql-direction-rtl) {
            padding-left: 24em;
        }

        .ql-editor li.ql-indent-8:not(.ql-direction-rtl) {
            padding-left: 25.5em;
        }

        .ql-editor .ql-indent-8.ql-direction-rtl.ql-align-right {
            padding-right: 24em;
        }

        .ql-editor li.ql-indent-8.ql-direction-rtl.ql-align-right {
            padding-right: 25.5em;
        }

        .ql-editor .ql-indent-9:not(.ql-direction-rtl) {
            padding-left: 27em;
        }

        .ql-editor li.ql-indent-9:not(.ql-direction-rtl) {
            padding-left: 28.5em;
        }

        .ql-editor .ql-indent-9.ql-direction-rtl.ql-align-right {
            padding-right: 27em;
        }

        .ql-editor li.ql-indent-9.ql-direction-rtl.ql-align-right {
            padding-right: 28.5em;
        }

        .ql-editor .ql-video {
            display: block;
            max-width: 100%;
        }

        .ql-editor .ql-video.ql-align-center {
            margin: 0 auto;
        }

        .ql-editor .ql-video.ql-align-right {
            margin: 0 0 0 auto;
        }

        .ql-editor .ql-bg-black {
            background-color: #000;
        }

        .ql-editor .ql-bg-red {
            background-color: #e60000;
        }

        .ql-editor .ql-bg-orange {
            background-color: #f90;
        }

        .ql-editor .ql-bg-yellow {
            background-color: #ff0;
        }

        .ql-editor .ql-bg-green {
            background-color: #008a00;
        }

        .ql-editor .ql-bg-blue {
            background-color: #06c;
        }

        .ql-editor .ql-bg-purple {
            background-color: #93f;
        }

        .ql-editor .ql-color-white {
            color: #fff;
        }

        .ql-editor .ql-color-red {
            color: #e60000;
        }

        .ql-editor .ql-color-orange {
            color: #f90;
        }

        .ql-editor .ql-color-yellow {
            color: #ff0;
        }

        .ql-editor .ql-color-green {
            color: #008a00;
        }

        .ql-editor .ql-color-blue {
            color: #06c;
        }

        .ql-editor .ql-color-purple {
            color: #93f;
        }

        .ql-editor .ql-font-serif {
            font-family: Georgia, Times New Roman, serif;
        }

        .ql-editor .ql-font-monospace {
            font-family: Monaco, Courier New, monospace;
        }

        .ql-editor .ql-size-small {
            font-size: 0.75em;
        }

        .ql-editor .ql-size-large {
            font-size: 1.5em;
        }

        .ql-editor .ql-size-huge {
            font-size: 2.5em;
        }

        .ql-editor .ql-direction-rtl {
            direction: rtl;
            text-align: inherit;
        }

        .ql-editor .ql-align-center {
            text-align: center;
        }

        .ql-editor .ql-align-justify {
            text-align: justify;
        }

        .ql-editor .ql-align-right {
            text-align: right;
        }

        .ql-editor.ql-blank::before {
            color: rgba(0, 0, 0, 0.6);
            content: attr(data-placeholder);
            font-style: italic;
            left: 15px;
            pointer-events: none;
            position: absolute;
            right: 15px;
        }
    </style>
</head>

<body>
    {{-- Landing page --}}
    <section>
        <div class="page no-padding">
            <main class="page-body page-break-after-always no-padding">
                <img src="{{ $coverPageImg }}" class="cover-page-img" />
                <img src="{{ $bnaLogo }}" class="no-padding cover-page-logo">
                <div class="first-section-text">
                    <p>Division Risques et Contrôle Permanant - <b>DRCP</b></p>
                    <p>Direction du Contrôle Permanant - <b>DCP</b></p>
                    <p>Département Contrôle - <b>{{ $mission->dre->name }}</b></p>
                </div>

                <span class="campaign-informations">
                    <p>CAMPAGNE DE CONTRÔLE</p>
                    <p>
                        2<sup>e</sup> NIVEAU <b>"{{ str_replace('cdc', '', $campaign->reference) }}"</b>
                    </p>
                </span>
                <p class="year">{{ Carbon\Carbon::parse($campaign->start_date)->format('Y') }}</p>
                <p class="report-title">
                    <b>RAPPORT</b><br>
                    DE MISSION
                </p>
                <div class="box agency">
                    {{ $mission->agency->name }} - {{ $mission->agency->code }}
                    @php
                        $start = Carbon\Carbon::parse($mission->start);
                        $end = Carbon\Carbon::parse($mission->end);
                        $class = '';
                        if ($start->year == $end->year && $start->month == $end->month) {
                            $start = $start->format('d');
                        } elseif ($start->year == $end->year && $start->month !== $end->month) {
                            $start = $start->format('d.m');
                            $class = ' with-month';
                        } else {
                            $start = $start->format('d.m.Y');
                            $class = ' with-year';
                        }
                        $end = $end->format('d.m.Y');
                    @endphp
                    <span class="date{{ $class }}">
                        Du {{ $start }} au {{ $end }}
                    </span>
                    <span class="reference">
                        Réf: {{ $mission->reference }}
                    </span>
                </div>

                <div class="validated_by">
                    <b>Validé par</b> {{ normalizeFullName($mission->cdc_validator_full_name) }}
                </div>

                <div class="controlled_by">
                    <b>Chef de mission</b>
                    {{ normalizeFullName(getUserFullNameWithRole($mission->ci_validation_by_id, true, false)) }}
                </div>
                @if ($mission->assistants_str)
                    <div class="assisted_by">
                        <b>Participant(s)</b> {{ $mission->assistants_str }}
                    </div>
                @endif

                <img src="{{ $appBrandMonochrome }}" alt="ControlPowerMonochrome" class="power-control-monochrome">
            </main>
        </div>
    </section>

    {{-- Sections header --}}
    <header class="page-header">
        <div class="container">
            <img src="{{ $bnaLogo }}" class="bna-logo" alt="Banque National D'Algérie">

            <div class="text-content">
                <p>Division Risques et Contrôle Permanent</p>
                <p>Direction du Contrôle Permanent</p>
            </div>
        </div>
    </header>

    {{-- Sections footer --}}
    <footer class="page-footer">
        <div class="container">
            <img src="{{ $appBrand }}" class="app-brand" alt="Control Power">
        </div>
    </footer>

    {{-- Main content --}}
    <main class="page-body report-area">
        <div class="container">
            <h1>Introduction</h1>
            <br>
            <div class="campaign-introduction">
                {!! $campaign->description !!}
            </div>
            <p>
                Ci-après les familles, domaines et processus à contrôler:
            </p>
            <br>

            <ul class="table-of-content">
                @foreach ($details as $family => $familyData)
                    <li><a href="#{{ $family }}">Famille: {!! ucfirst(strtolower($family)) !!}</a></li>
                    <ul>
                        @php
                            $domains = $familyData->groupBy('domain');
                        @endphp
                        @foreach ($domains as $domain => $domainData)
                            @php
                                $domain = json_decode($domain);
                            @endphp
                            <li><a href="#{{ $family . '-' . $domain->id }}">Domaine: {{ $domain->name }}</a></li>
                            <ul>
                                @php
                                    $processes = $domainData->groupBy('process');
                                @endphp
                                @foreach ($processes as $process => $processData)
                                    @php
                                        $process = json_decode($process);
                                    @endphp
                                    <li><a href="#{{ $family . '-' . $domain->id . '-' . $process->id }}">Processus:
                                            {{ $process->name }}</a></li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                    <br>
                @endforeach
            </ul>

            <div class="page-break-after-always"></div>

            <h2>Fiche technique</h2>
            <br>
            <div class="table-container">
                <table>
                    <tr>
                        <td>Référence de la campagne</td>
                        <td>{{ $campaign->reference }}</td>
                    </tr>
                    <tr>
                        <td>Département contrôle</td>
                        <td>{{ $mission->dre->name }} - {{ $mission->dre->code }}</td>
                    </tr>
                    <tr>
                        <td>Agence contrôler</td>
                        <td>{{ $mission->agency->name }} - {{ $mission->agency->code }}</td>
                    </tr>
                    <tr>
                        <td>Référence du rapport</td>
                        <td>{{ $mission->reference }}</td>
                    </tr>
                    <tr>
                        <td>Date début</td>
                        <td>{{ $mission->start }}</td>
                    </tr>
                    <tr>
                        <td>Date fin</td>
                        <td>{{ $mission->end }}</td>
                    </tr>
                    <tr>
                        <td>Contrôle sur place</td>
                        <td>{{ getUserFullNameWithRole($mission->dreController->id) }}</td>
                    </tr>
                    <tr>
                        <td>Validé par</td>
                        <td>{{ $mission->cdc_report?->creator->full_name }}</td>
                    </tr>
                </table>
            </div>
            <br>

            <h2>Chiffres clés</h2>
            <br>

            <div class="table-container">
                <table>
                    <tr>
                        <td>Note moyenne du rapport</td>
                        <td>{{ $stats['avg_score'] }}</td>
                    </tr>
                    <tr>
                        <td>Nombre de processus contrôlés</td>
                        <td>{{ $stats['total_processes'] }} processus</td>
                    </tr>
                    <tr>
                        <td>Nombres des anomalies</td>
                        <td>{{ $stats['total_anomalies'] }}
                            {{ $stats['total_anomalies'] > 1 ? 'anomalies' : 'anomalie' }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="page-break-before-always"></div>

            @foreach ($details as $family => $familyData)
                <div class="page-break-before-auto"></div>
                <h2 id="{{ $family }}">Famille: {!! $family !!}</h2>
                @php
                    $domains = $familyData->groupBy('domain');
                @endphp
                @foreach ($domains as $domain => $domainData)
                    @php
                        $domain = json_decode($domain);
                    @endphp
                    <h3 id="{{ $family . '-' . $domain->id }}">Domaine: {{ $domain->name }}</h3>
                    @php
                        $processes = $domainData->groupBy('process');
                    @endphp
                    @foreach ($processes as $process => $processData)
                        @php
                            $process = json_decode($process);
                        @endphp
                        <h4 id="{{ $family . '-' . $domain->id . '-' . $process->id }}">Processus:
                            {{ $process->name }}
                        </h4>
                        @foreach ($processData as $controlPoint => $item)
                            @php
                                // if (in_array($item->score, [2, 3, 4]) && !$item->major_fact) {
                                //     $captionClass = 'is-anomaly';
                                // } elseif ($item->major_fact) {
                                //     $captionClass = 'is-danger';
                                // } else {
                                //     $captionClass = 'is-success';
                                // }
                                if (in_array($item->score, [2, 3, 4])) {
                                    $captionClass = 'is-anomaly';
                                } else {
                                    $captionClass = 'is-success';
                                }
                            @endphp
                            <div class="table-container">
                                <table>
                                    <caption class="{{ $captionClass }}">{{ $item->controlPoint->name }}</caption>
                                    <tbody>
                                        <tr>
                                            <th class="margin-cell"></th>
                                            <th>Notation</th>
                                            <td>{{ $item->appreciation }}</td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        {{-- @if ($item->major_fact)
                                            <tr>
                                                <th class="margin-cell"></th>
                                                <th>Fait majeur</th>
                                                <td
                                                    class="text-danger has-major_fact">
                                                    Déclencher par {{ $item->major_fact_is_detected_by_full_name }}
                                                    le {{ $item->major_fact_is_detected_at }}
                                                </td>
                                                <th class="margin-cell"></th>
                                            </tr>
                                        @endif --}}
                                        <tr>
                                            <th class="margin-cell"></th>
                                            <th>Constat</th>
                                            <td>{!! $item?->observation?->content ?? '-' !!}</td>
                                            <th class="margin-cell"></th>
                                        </tr>
                                        @if ($item->score != 1)
                                            <tr>
                                                <th class="margin-cell"></th>
                                                <th>Plan de redressement</th>
                                                <td>{!! $item?->recovery_plan ?? '-' !!}</td>
                                                <th class="margin-cell"></th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                {{-- Metadata --}}
                                @php
                                    $lines = $item?->parsed_metadata['lines'];
                                    $metadata = $item?->parsed_metadata['metadata'];
                                @endphp
                                @if ($lines)
                                    <table>
                                        <tr>
                                            <td colspan="4" class="text-center bg-gray">
                                                <b>Constats liés à l'échantillonage</b>
                                            </td>
                                        </tr>
                                        @php
                                            $currentIndex = 0;
                                        @endphp
                                        @foreach ($metadata as $rows)
                                            @php
                                                $totalRows = count($rows);
                                                $currentRow = 1;
                                            @endphp
                                            @foreach ($rows as $row)
                                                <tr
                                                    class="metadata-row {{ $totalRows == $currentRow && $lines !== $currentIndex ? 'border-bottom' : null }}">
                                                    <th class="margin-cell"></th>
                                                    <th>
                                                        {{ $row?->label }}
                                                    </th>
                                                    <td>
                                                        {{ $row?->value }}
                                                    </td>
                                                    <th class="margin-cell"></th>
                                                    @php
                                                        $currentRow += 1;
                                                    @endphp
                                            @endforeach
                                            @php
                                                $currentIndex += 1;
                                            @endphp
                                        @endforeach
                                    </table>
                                @endif
                            </div>
                            {{-- Supporting documents --}}

                            @if ($item?->images?->count())
                                <h4>Pièces justificatifs</h4>
                                @foreach ($item->images as $image)
                                    <div class="img-container">
                                        <img src="{{ public_path('storage/' . $image->path) }}"
                                            alt="{{ $image->original_name }}"
                                            class="img">
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </div>
        <div class="container">
            <div class="page-break-before-always"></div>
            <h2>Conclusion du chef de département</h2>
            {!! $mission->cdc_report->content !!}
            @if ($mission->closingReport)
                <div class="page-break-before-auto"></div>
                <h2>PV de clôture</h2>
                @foreach ($mission->closingReport as $report)
                    <div class="img-container">
                        <img src="{{ public_path('storage/' . $report->path) }}" alt="{{ $report->original_name }}"
                            class="img">
                    </div>
                @endforeach
            @endif
        </div>
    </main>
</body>

</html>
