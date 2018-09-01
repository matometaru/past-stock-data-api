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
            + market: 0 (enum) - 銘柄種別(0:東証1部, 1:東証2部)
                + 0 (number)
                + 1 (number)
            + category (enum) - 銘柄種別(0:東証1部, 1:東証2部)
                + 0 (number)
                + 1 (number)
            + color: `64c200` (string)
            + url: `http://www.ulsgroup.co.jp/` (string)
            + listingDate: `2015-06-11` (string)
            + delistingDate: `2115-06-11` (string)

+ Response 404 (application/json)
 
    + Attributes
        + error (required)
            + code: 404 (number, required)
            + message: ULSグループ (string, required) - 銘柄が見つかりません。