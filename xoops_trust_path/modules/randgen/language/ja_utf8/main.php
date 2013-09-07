<?php
/**
 * @file
 * @package randgen
 * @version $Id$
**/

define('_MD_RANDGEN_ERROR_REQUIRED', '{0}は必ず入力して下さい');
define('_MD_RANDGEN_ERROR_MINLENGTH', '{0}は半角{1}文字以上にして下さい');
define('_MD_RANDGEN_ERROR_MAXLENGTH', '{0}は半角{1}文字以内で入力して下さい');
define('_MD_RANDGEN_ERROR_EXTENSION', 'アップロードされたファイルは許可された拡張子と一致しません');
define('_MD_RANDGEN_ERROR_INTRANGE', '{0}の入力値が不正です');
define('_MD_RANDGEN_ERROR_MIN', '{0}は{1}以上の数値を指定して下さい');
define('_MD_RANDGEN_ERROR_MAX', '{0}は{1}以下の数値を指定して下さい');
define('_MD_RANDGEN_ERROR_OBJECTEXIST', '{0}の入力値が不正です');
define('_MD_RANDGEN_ERROR_DBUPDATE_FAILED', 'データベースの更新に失敗しました');
define('_MD_RANDGEN_ERROR_EMAIL', '{0}は不正なメールアドレスです');
define('_MD_RANDGEN_ERROR_PERMISSION', '権限がありません');
define('_MD_RANDGEN_MESSAGE_CONFIRM_DELETE', '以下のデータを本当に削除しますか？');
define('_MD_RANDGEN_LANG_CONTROL', 'CONTROL');
define('_MD_RANDGEN_ERROR_CONTENT_IS_NOT_FOUND', 'コンテンツが見つかりません');

define('_MD_RANDGEN_LANG_GENERATOR_ID', 'Generator id');
define('_MD_RANDGEN_LANG_TITLE', 'タイトル');
define('_MD_RANDGEN_LANG_UID', 'ユーザ');
define('_MD_RANDGEN_LANG_CATEGORY_ID', 'カテゴリ');
define('_MD_RANDGEN_LANG_DESCRIPTION', 'ランダム表の説明');
define('_MD_RANDGEN_LANG_ITEMS', 'ランダム表');
define('_MD_RANDGEN_LANG_POSTTIME', '作成日');
define('_MD_RANDGEN_LANG_ADD_A_NEW_GENERATOR', 'ランダム表の新規追加');
define('_MD_RANDGEN_LANG_GENERATOR_EDIT', 'ランダム表の編集');
define('_MD_RANDGEN_LANG_GENERATOR_DELETE', 'ランダム表の削除');
define('_MD_RANDGEN_LANG_GENERATOR', 'ランダム表');
define('_MD_RANDGEN_LANG_COPY', 'コピー');
define('_MD_RANDGEN_LANG_SHOW_ALL', 'すべて表示する');
define('_MD_RANDGEN_LANG_FILTER_BY_UID', '自分のランダム表を表示する');
define('_MD_RANDGEN_MESSAGE_ITEMS_FORMAT', '「**」を入れると結果の先頭とみなされます。その後ろに、以下のルールでランダム表の結果を入力していってください。それぞれのルールの間は、 | で区切ります。<ul></li><li>出現割合（数字）。この数字を、全出現割合を足した数字で割った数が、出現確率となります</li><li>内容を入力します。HTMLタグは使えません。{123456} のように、ランダム表のIDの数字を { } で囲って本欄に記述すると、そのランダム表の結果が挿入されます。</li><li>（任意）この結果が出た時に、このランダム表での再ロールする回数</li><li>（任意）この結果が出た時に参照する子となるランダム表のID（generator_id）。「,」で区切ってIDを複数入力することも出来ます。</li></ul>');

define('_MD_RANDGEN_LANG_PAGE_ID', 'Page id');
define('_MD_RANDGEN_LANG_ADD_A_NEW_PAGE', 'ページの新規追加');
define('_MD_RANDGEN_LANG_PAGE_EDIT', 'ページの編集');
define('_MD_RANDGEN_LANG_PAGE_DELETE', 'ページの削除');
define('_MD_RANDGEN_LANG_PAGE', 'ページ');

define('_MD_RANDGEN_LANG_LINK_ID', 'Link id');
define('_MD_RANDGEN_LANG_WEIGHT', 'Weight');
define('_MD_RANDGEN_LANG_ADD_A_NEW_LINK', 'Add a new Link');
define('_MD_RANDGEN_LANG_LINK_EDIT', 'Link Edit');
define('_MD_RANDGEN_LANG_LINK_DELETE', 'Link Delete');
define('_MD_RANDGEN_LANG_LINK', 'Link');



?>
