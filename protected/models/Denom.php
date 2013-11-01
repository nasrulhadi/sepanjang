<?php

/**
 * This is the model class for table "denom".
 *
 * The followings are the available columns in table 'denom':
 * @property integer $dnm_id
 * @property string $opt_code
 * @property integer $dnm_nominal
 * @property integer $dnm_price
 * @property string $dnm_date
 */
class Denom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'denom';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('opt_code, dnm_nominal, dnm_price, dnm_date', 'required'),
			array('dnm_nominal, dnm_price', 'numerical', 'integerOnly'=>true),
			array('opt_code', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dnm_id, opt_code, dnm_nominal, dnm_price, dnm_date', 'safe', 'on'=>'search'),
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
			'dnm_id' => 'Dnm',
			'opt_code' => 'Opt Code',
			'dnm_nominal' => 'Dnm Nominal',
			'dnm_price' => 'Dnm Price',
			'dnm_date' => 'Dnm Date',
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

		$criteria->compare('dnm_id',$this->dnm_id);
		$criteria->compare('opt_code',$this->opt_code,true);
		$criteria->compare('dnm_nominal',$this->dnm_nominal);
		$criteria->compare('dnm_price',$this->dnm_price);
		$criteria->compare('dnm_date',$this->dnm_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Denom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
