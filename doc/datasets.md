FORMAT: 1A
 
# Group 株価
 
## 株価情報取得 [/v1/datasets/{code}{?start-date,end-date,frequency}]
 
### 株価情報取得API [GET]
 
#### 処理概要
 
* 指定した株価情報を返す。
* start-dateとend-dateを指定した場合は、その期間の株価情報を返す。
* frequencyで日足、週足、月足、四半期足、年足の株価を返す。
 
+ Parameters
 
    + `code`: 3798 (number, required) - 銘柄番号
    + `start-date`: `2018-08-01` (string, optional) - 取得開始日
    + `end-date`: `2018-08-31` (string, optional) - 取得終了日
    + frequency: `none` (enum, optional) - 取得間隔
        + `none` (string)
        + `daily` (string)
        + `weekly` (string)
        + `monthly` (string)
        + `quarterly` (string)
        + `annual` (string)

+ Response 200 (application/json)
 
    + Attributes
        + dataset (required)
            + code: 3798 (number, required)
            + name: ULSグループ (string, required)
            + startDate: `2018-08-01` (string)
            + endDate: `2018-08-31` (string)
            + frequency: `daily` (string)
            + data (array)
                + (object)
                    + date: `2018-08-01` (string, required)
                    + asset: 100 (number) - 発行済株式総数
                    + profit : 100 (number) - 当期純利益
                    + open: 100 (number) - 始値
                    + high: 100 (number) - 高値
                    + low: 100 (number) - 安値
                    + close: 100 (number) - 終値
                    + volume: 100 (number) - 出来高
                + (object)
                    + date: `2018-08-02` (string, required)
                    + asset: 100 (number) - 発行済株式総数
                    + profit : 100 (number) - 当期純利益
                    + open: 100 (number) - 始値
                    + high: 100 (number) - 高値
                    + low: 100 (number) - 安値
                    + close: 100 (number) - 終値
                    + volume: 100 (number) - 出来高

+ Response 404 (application/json)
 
    + Attributes
        + error (required)
            + code: 404 (number, required)
            + message: ULSグループ (string, required) - 株価が見つかりません。