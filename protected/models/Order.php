<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $ord_id
 * @property integer $opt_id
 * @property string $opt_code
 * @property integer $dnm_nominal
 * @property string $ord_dest
 * @property string $ord_date
 * @property integer $ord_bayar
 * @property string $ord_bank
 * @property string $ord_desc
 * @property string $ord_status
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('opt_id, opt_code, dnm_nominal, ord_dest, ord_date, ord_bayar, ord_bank, ord_desc', 'required'),
			array('opt_id, dnm_nominal, ord_bayar', 'numerical', 'integerOnly'=>true),
			array('opt_code', 'length', 'max'=>10),
			array('ord_dest', 'length', 'max'=>19),
			array('ord_bank', 'length', 'max'=>20),
			array('ord_desc', 'length', 'max'=>50),
			array('ord_status', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ord_id, opt_id, opt_code, dnm_nominal, ord_dest, ord_date, ord_bayar, ord_bank, ord_desc, ord_status', 'safe', 'on'=>'search'),
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
			'ord_id' => 'Ord',
			'opt_id' => 'Opt',
			'opt_code' => 'Opt Code',
			'dnm_nominal' => 'Dnm Nominal',
			'ord_dest' => 'Ord Dest',
			'ord_date' => 'Ord Date',
			'ord_bayar' => 'Ord Bayar',
			'ord_bank' => 'Ord Bank',
			'ord_desc' => 'Ord Desc',
			'ord_status' => 'Ord Status',
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

		$criteria->compare('ord_id',$this->ord_id);
		$criteria->compare('opt_id',$this->opt_id);
		$criteria->compare('opt_code',$this->opt_code,true);
		$criteria->compare('dnm_nominal',$this->dnm_nominal);
		$criteria->compare('ord_dest',$this->ord_dest,true);
		$criteria->compare('ord_date',$this->ord_date,true);
		$criteria->compare('ord_bayar',$this->ord_bayar);
		$criteria->compare('ord_bank',$this->ord_bank,true);
		$criteria->compare('ord_desc',$this->ord_desc,true);
		$criteria->compare('ord_status',$this->ord_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
