<?php

/**
 * This is the model class for table "nourut".
 *
 * The followings are the available columns in table 'nourut':
 * @property integer $idurut
 */
class Nourut extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nourut';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idurut', 'required'),
			array('idurut', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idurut', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idurut' => 'Idurut',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idurut',$this->idurut);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nourut the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function getRandom()
	{
		$random = mt_rand(32, 128);

		$sql = "SELECT LPAD(CONVERT(MIN(n.idurut), CHAR(2)),2,'0') as ANGKA 
				FROM `order` o 
				RIGHT OUTER JOIN nourut n on LPAD(n.idurut,2,'0') = RIGHT(CONVERT(o.ord_bayar, CHAR(6)),2) AND o.ord_status IN('waiting','sukses','proses','refund') where 1 AND RIGHT(CONVERT(o.ord_bayar, CHAR(6)),2) is NULL";
		$connection = Yii::app()->db;

		$command = $connection->createCommand($sql);
		$result = $command->queryAll();
		foreach ($result as $key) {
			$random = $key["ANGKA"];
		}

		return $random;
	}

	public function enHash($int)
	{
		$random1 = mt_rand(111, 511);
		$random2 = mt_rand(11, 99);

		return $random1.$int.$random2;
	}

	public function deHash($int)
	{
		return substr($int, 3, -2);
	}
}
