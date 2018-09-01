FORMAT: 1A
 
# Group 業績
 
## 業績情報取得 [/v1/performances/{code}]
 
### 業績情報取得API [GET]
 
#### 処理概要
 
* 指定した業績の情報を返す。
 
+ Parameters
 
    + `code`: 3798 (number, required) - 銘柄番号
 
+ Response 200 (application/json)
 
    + Attributes
        + performance (object)
            + code: 3798 (number)
            + name: ULSグループ (string)
            + sales: 100 (number)
            + profit: 100 (number) - 発行済株式総数
            + expense : 100 (number) - 当期純利益
            + income: 100 (number) - 始値
            + diviend: 100 (number) - 高値

+ Response 404 (application/json)
 
    + Attributes
        + error (required)
            + code: 404 (number, required)
            + message: ULSグループ (string, required) - 業績が見つかりません。