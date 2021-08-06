<?php

namespace yii\helpers;
use Yii;

class Utils

{

    public static function getDsnAttribute($name, $dsn)
    {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }

    public static function getNomorTransaksi($model, $kode, $select, $order)
    {


        $no_transaksi = '';
        $penyesuaian_kas = $model::find()->select([$select])->orderBy(" $order DESC")->limit(1)->one();
        if (!empty($penyesuaian_kas->$select)) {
            # code...
            $no_bulan = substr($penyesuaian_kas->$select, 2, 4);
            if ($no_bulan == date('ym')) {
                # code...
                $noUrut = substr($penyesuaian_kas->$select, -3);
                $noUrut++;
                $noUrut_2 = sprintf("%03s", $noUrut);
                $no_transaksi = $kode . date('ym') . $noUrut_2;
            } else {
                # code...
                $no_transaksi = $kode . date('ym') . '001';
            }
        } else {
            # code...
            $no_transaksi = $kode . date('ym') . '001';
        }

        return $no_transaksi;
    }

    public static function getCountTable($thisId, $columnName, $thisTable)
    {
        $db = Yii::$app->getDb();
        $dbname = 'dbname';
        $dsn = $db->dsn;
        $dbName = getDsnAttribute($dbname, $dsn);
        $rows = (new \yii\db\Query())
            ->select(['TABLE_NAME'])
            ->from('INFORMATION_SCHEMA.COLUMNS')
            ->where(['TABLE_SCHEMA' => $dbName])
            ->andWhere(['COLUMN_NAME' => $columnName])
            ->andWhere(['!=', 'TABLE_NAME', $thisTable])
            ->all();
        $array_table_name = array();
        $totalan_countData = 0;
        foreach ($rows as $key => $value) {
            # code...
            $rows2 = (new \yii\db\Query())
                ->select(['COUNT(*) as countData'])
                ->from($value['TABLE_NAME'])
                ->where([$columnName => $thisId])
                ->one();


            $countDataRows2 = $rows2['countData'];
            $array_table_name[] = $value['TABLE_NAME'] . ' - ' . $countDataRows2;
            $totalan_countData += $countDataRows2;
        }

        return $totalan_countData;
    }

    public static function notifCount($nama, $id, $where_status)
    {
        if (!empty($nama)) {
            $count = Yii::$app->db->createCommand("SELECT COUNT($id) FROM $nama WHERE $where_status ")->queryScalar();
            return $count;
        }
    }

    public static function notif($nama_tabel, $nama_id, $nama_nomer, $nama_view, $nama, $where)
    {
        if (!empty($nama)) {
            $q = "SELECT $nama_id as id, '$nama_tabel' as tabel, $nama_nomer as no, '$nama_view' as view, '$nama' as nama FROM $nama_tabel WHERE $where";
            return $q;
        }
    }

    public static function nominal($nominal)
    {
        if (!is_numeric($nominal)) {
            return false;
        } else {
            return ($nominal >= 0) ? ribuan($nominal) : '(' . ribuan(abs($nominal)) . ')';
        }
    }

    public static function role($role)
    {
        return in_array($role, Yii::$app->session->get('user_role'));
    }

    public static function cekDoubleJu($id, $nama_tabel)
    {
        $q = AktHistoryTransaksi::find()->where(['id_tabel' => $id, 'nama_tabel' => $nama_tabel])->count();
        return $q > 1 && true;
    }

    public static function plusMinusTanggal($tanggal, $day)
    {
        if ($day === 'bulan_lalu') {
            $m = substr($tanggal, 5, 2);
            $d = substr($tanggal, 8, 2);
            $y = substr($tanggal, 0, 4);
            $mo = ($m - 1) < 10 ? '0' . ($m - 1) : ($m - 1);
            return $y . '-' . $mo . '-' . $d;
        }
        return date('Y-m-d', strtotime($day . ' days', strtotime($tanggal)));
    }
}
