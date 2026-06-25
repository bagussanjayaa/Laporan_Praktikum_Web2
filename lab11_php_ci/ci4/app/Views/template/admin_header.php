<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
    <style>
        #admin-container {
            width: 960px;
            margin: 0 auto;
            border: 1px solid #ccc;
            font-family: sans-serif;
        }
        #admin-container header {
            padding: 20px;
            background: #fff;
            color: #aaa;
        }
        #admin-container header h1 {
            font-size: 28px;
            margin: 0;
        }
        #admin-container nav {
            background: #1a73e8;
            padding: 0;
        }
        #admin-container nav a {
            color: #fff;
            display: inline-block;
            padding: 12px 25px;
            text-decoration: none;
        }
        #admin-container nav a:hover,
        #admin-container nav a.active {
            background: #1557b0;
        }
        #admin-main {
            padding: 20px;
            min-height: 400px;
        }
        /* TABLE */
        table.table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.table th {
            background: #1557b0;
            color: #fff;
            padding: 10px 12px;
            text-align: left;
        }
        table.table td {
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }
        table.table tr:nth-child(even) {
            background: #f5f5f5;
        }
        table.table tfoot th {
            background: #1557b0;
            color: #fff;
            padding: 10px 12px;
        }
        /* BUTTONS */
        .btn {
            display: inline-block;
            padding: 5px 12px;
            background: #1557b0;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            font-size: 13px;
            margin-right: 4px;
        }
        .btn-danger {
            background: #cc0000;
        }
        .btn:hover { opacity: 0.85; }
        /* FORM */
        #admin-main h2 {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #1a73e8;
            padding-bottom: 8px;
        }
        #admin-main form p {
            margin: 12px 0;
        }
        #admin-main form input[type="text"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        /* FORM SEARCH */
        .form-search {
            margin-bottom: 15px;
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .form-search input[type="text"] {
            width: 200px !important;
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            display: inline-block;
        }
        .form-search input[type="submit"] {
            padding: 8px 18px !important;
            width: auto !important;
            background: #1557b0;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            cursor: pointer;
        }
        .form-search input[type="submit"]:hover {
            background: #1a73e8;
        }
        #admin-main form textarea {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            resize: vertical;
        }
        #admin-main form input[type="submit"] {
            padding: 8px 24px;
            background: #1557b0;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            cursor: pointer;
        }
        #admin-main form input[type="submit"]:hover {
            background: #1a73e8;
        }
       /* PAGINATION */
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin-top: 15px;
    background: transparent;
}
.pagination li {
    display: inline-block;
    margin-right: 6px;
}
.pagination li a,
.pagination li span {
    display: inline-block;
    padding: 6px 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    color: #555;
    text-decoration: none;
    font-size: 14px;
    background: #d0d0d0;
    min-width: 35px;
    text-align: center;
}
.pagination li.active a,
.pagination li.active span {
    background: #1557b0;
    color: #fff;
    border-color: #1557b0;
}
.pagination li a:hover {
    background: #bdbdbd;
    color: #333;
}
.pagination li.disabled span {
    color: #aaa;
    background: #f0f0f0;
    border-color: #ddd;
    cursor: not-allowed;
}
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin-top: 15px;
    margin-bottom: 5px;
    background: #fff;
}
        #admin-container footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 13px;
        }
    </style>
</head>
<body>
<div id="admin-container">
    <header>
        <h1>Admin Portal Berita</h1>
    </header>
    <nav>
        <a href="<?= base_url('/admin/artikel');?>">Dashboard</a>
        <a href="<?= base_url('/admin/artikel');?>">Artikel</a>
        <a href="<?= base_url('/admin/artikel/add');?>">Tambah Artikel</a>
        <a href="<?= base_url('/user/logout');?>" 
           style="float:right; background:#cc0000;">Logout</a>
    </nav>
    <div id="admin-main">