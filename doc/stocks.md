FORMAT: 1A
 
# Group 銘柄
 
## 銘柄情報取得 [/v1/stocks/{code}]
 
### 銘柄情報取得API [GET]
 
#### 処理概要
 
* 指定した銘柄の情報を返す。
 
+ Parameters
 
    + `code`: 3798 (number, required) - 銘柄番号
 
+ Response 200 (application/json)
 
    + Attributes
        + stock (object)
            + code: 3798 (number)
            + name: ULSグループ (string)
            + market: 0 (enum) - 銘柄種別(1:東証1部, 2:東証2部, 3:マザーズ, 4:JASDAQスタンダード, 5:JASDAQグロース, 6:名証1部, 7:名証2部, 8:名証セントレックス, 9:札証, 10:福証)
                + 1 (number)
                + 2 (number)
                + 3 (number)
                + 4 (number)
                + 5 (number)
                + 6 (number)
                + 7 (number)
                + 8 (number)
                + 9 (number)
                + 10 (number)
            + category (enum) - 銘柄種別(1:水産・農林, 2:鉱業, 3:建設業, 4:食料品, 5:繊維製品, 6:パルプ・紙, 7:化学, 8:医薬品, 9:石油・石炭, 10:ゴム, 11:ガラス・土石, 12:鉄鋼, 13:非鉄金属, 14:金属製品, 15:機械, 16:電気機器, 17:輸送用機器, 18:精密機器, 19:その他製品, 20:電気・ガス, 21:陸運, 22:海運, 23:空運, 24:倉庫・運輸, 25:情報・通信, 26:卸売, 27:小売, 28:銀行, 29:証券・商先, 30:保険, 31:その他金融, 32:不動産, 33:サービス )
                + 1 (number)
                + 2 (number)
                + 3 (number)
                + 4 (number)
                + 5 (number)
                + 6 (number)
                + 7 (number)
                + 8 (number)
                + 9 (number)
                + 10 (number)
                + 11 (number)
                + 12 (number)
                + 13 (number)
                + 14 (number)
                + 15 (number)
                + 16 (number)
                + 17 (number)
                + 18 (number)
                + 19 (number)
                + 20 (number)
                + 21 (number)
                + 22 (number)
                + 23 (number)
                + 24 (number)
                + 25 (number)
                + 26 (number)
                + 27 (number)
                + 28 (number)
                + 29 (number)
                + 30 (number)
                + 31 (number)
                + 32 (number)
                + 33 (number)
            + color: `64c200` (string)
            + url: `http://www.ulsgroup.co.jp/` (string)
            + listingDate: `2015-06-11` (string)
            + delistingDate: `2115-06-11` (string)

+ Response 404 (application/json)
 
    + Attributes
        + error (required)
            + code: 404 (number, required)
            + message: ULSグループ (string, required) - 銘柄が見つかりません。